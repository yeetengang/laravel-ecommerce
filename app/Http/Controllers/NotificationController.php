<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    // get all notification that haven't checked
    public function getNotifications() {
        $notifications = Notification::all();

        return $notifications;
    }

    // Update notification if checked
    public function updateNotification(Request $request) {
        $notification = Notification::find($request->id);

        if ($notification) {
            $notification->checked = $request->checked;
            $notification->save();
        }
    
        return response()->json(
            [
                'message' => 'Notification updated successfully',
                'notification' => $notification
            ]
        ); 
    }
}
