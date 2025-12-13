<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\PasswordRequest;
use App\Models\Post;
use App\Models\Governrate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ClientProfileController extends Controller
{

    public function password()
    {
        return view('website.profile.password');
    }

    public function changePassword(PasswordRequest $request)
    {
        $client = auth('client')->user();
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $client->update($validated);
        return redirect()->route('website.page')->with("user_message", __("messages.PASSWORDCHANGEDSUCCESSFULLY"));
    }

    public function favoritePosts()
    {
        $client = auth('client')->user();
        $favoritePosts = $client->fav()
            ->wherePivot('is_favorite', 1)
            ->paginate(1);

        return view('website.profile.myfavorites', compact('favoritePosts'));
    }

    public function toggleFavoriteGeneric($id, $redirectTo = null)
    {
        $client = auth('client')->user();
        $post = Post::findOrFail($id);

        $pivot = $client->fav()->where('post_id', $id)->first();

        if ($pivot) {
            $isFavorite = $pivot->pivot->is_favorite ? 0 : 1;
            $client->fav()->updateExistingPivot($id, ['is_favorite' => $isFavorite]);
        } else {
            $client->fav()->attach([$id => ['is_favorite' => 1]]);
            $isFavorite = 1;
        }

        $message = $isFavorite
            ? __('messages.favorite_added')
            : __('messages.favorite_removed');

        if (request()->ajax()) {
            return response()->json([
                'status' => $isFavorite,
                'message' => $message
            ]);
        }

        switch ($redirectTo) {
            case 'favorites':
                return redirect()->route('website.posts.favorites')->with('user_message', $message);
            case 'details':
                return redirect()->route('website.articles.show', $post->id)->with('user_message', $message);
            default:
                return redirect()->route('website.articles.index')->with('user_message', $message);
        }
    }
    public function edit(Request $request): View
    {
        return view('website.profile.edit', [
            'user' => $request->user('client'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('client')->fill($request->validated());

        if ($request->user('client')->isDirty('email')) {
            $request->user('client')->email_verified_at = null;
        }

        $request->user('client')->save();

        return Redirect::route('website.page')->with('user_message', 'your profile updated successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user('client');

        $user->fav()->detach();

        $donations = $user->donations()->get();

        foreach ($donations as $donation) {
            $notifications = $donation->notifications()->get();
            foreach ($notifications as $notification) {
                $notification->clients()->detach();
                $notification->delete();
            }
            $donation->delete();
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
