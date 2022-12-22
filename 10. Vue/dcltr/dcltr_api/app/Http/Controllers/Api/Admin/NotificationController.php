<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\NotificationsResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function allNotifications() {
        return new NotificationsResource(auth()->user()->notifications);
    }

    public function markNotificationsAsRead() {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['message'=>__('apiMessage.markNotificationsAsRead')], 200);
    }

    public function unreadNotificationsCount() {
        $data = [];
        $data['unreadNotificationsCount'] = auth()->user()->unreadNotifications->count();
        return new NotificationsResource($data);
    }

    public function markNotificationAsRead($notificationId) {
        auth()->user()->unreadNotifications->where('id', $notificationId)->markAsRead();
        return response()->json(['message'=>__('apiMessage.markNotificationAsRead')], 200);
    }
}
