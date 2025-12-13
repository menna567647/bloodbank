<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Auth('client')->user();
        $notifications = $client->notifications()->latest()->paginate(10);
        return view('website.notifications.index', compact('notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $client = Auth('client')->user();
        $notification = Notification::find($id);
        $pivot = $client->notifications()->where('notification_id', $notification->id)->first();

        if ($pivot) {
            $is_read = $pivot->pivot->is_read;
            if ($is_read == 0) {
                $client->notifications()->updateExistingPivot($id, ['is_read' => 1]);
                return redirect()->route('website.client.notifications')->with('message', __("messages.marked_as_read"));
            } else if ($is_read == 1) {
                $client->notifications()->updateExistingPivot($id, ['is_read' => 0]);
                return redirect()->route('website.client.notifications')->with('message', __("messages.marked_as_not_read"));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Auth('client')->user();
        $client->notifications()->detach($id);
        return redirect()->route('website.client.notifications')->with("message",  __("messages.deleted_successfully"));
    }

    /**
     * Remove all resources from storage.
     */
    public function destroyAll()
    {
        $client = Auth('client')->user();
        $client->notifications()->detach();
        return redirect()->route('website.client.notifications')->with("message",  __("messages.deleted_successfully"));
    }
}
