<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Website\ContactRequest;
use App\Models\Post;
use App\Models\Donation;
use App\Models\Bloodtype;
use App\Models\Category;
use App\Models\Governrate;
use App\Models\Contact;


class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->take(10)->get();
        $donations = Donation::where('is_spam', 0)
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();
        $governorates = Governrate::all();
        $bloodTypes = Bloodtype::all();
        return view('website.home', compact('posts', 'donations', 'governorates', 'bloodTypes'));
    }


    public function aboutus()
    {
        return view('website.about-us');
    }


    public function requests(Request $request)
    {
        $donations = Donation::with(['bloodType', 'city.governrate'])->where('is_spam', '0')->where('status', 'pending')
            ->when($request->filled('blood_type_id'), function ($query) use ($request) {
                $query->where('blood_type_id', $request->blood_type_id);
            })
            ->when($request->filled('governrate_id'), function ($query) use ($request) {
                $query->whereHas('city', function ($q) use ($request) {
                    $q->where('governrate_id', $request->governrate_id);
                });
            })
            ->paginate(10)
            ->appends($request->query());


        $governrates = Governrate::all();
        $bloodTypes = Bloodtype::all();

        return view('website.requests.index', compact('donations', 'governrates', 'bloodTypes'));
    }


    public function requestDetail($id)
    {
        $donation = Donation::findOrFail($id);
        return view('website.requests.detail', compact('donation'));
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function contactStore(ContactRequest $request)
    {
        $validated = $request->validated();
        if (auth()->guard('client')->check()) {
            $data['client_id'] = auth()->guard('client')->id();
        } else {
            $data['client_id'] = null;
        }
        Contact::create($validated);
        return redirect()->back()->with('success', __('messages.message_sent_successfully'));
    }
}
