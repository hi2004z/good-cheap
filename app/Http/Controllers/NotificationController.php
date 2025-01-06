<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
   
    public function show()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->user_id)->get();
        return view('notification.view_notification', compact('notifications'));
    }
    

    public function detail(string $id)
    {
        $notification = Notification::findOrFail($id);
        return view('notification.detail_notification', compact('notification'));
    }

   
}
