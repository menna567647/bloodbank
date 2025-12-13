<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    use ApiResponse;

    public function index()
    {

        $notifications = Notification::all();
        $data = [
            'notifications' => $notifications
        ];

        return $this->apiDataResponse($data);
    }


    public function isRead($id)
    {
        $client = Auth('api')->user();
        $notification = Notification::find($id);
        
        if (!$notification) {
            return response()->json(['error' => 'Notification not found.'], 404);
        }

        $attached = $client->notifications()->where('notification_id', $id)->exists();

        if ($attached) {
            $client->notifications()->updateExistingPivot($id, ['is_read' => 1]);
        } else {
            $client->notifications()->attach($id, ['is_read' => 1]);
        }

        return response()->json(['message' => 'Notification marked as read']);
    }
}
