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
        $notifications = Notification::where('user_id', $user->user_id)
            ->orderByRaw("CASE WHEN status = 'unread' THEN 0 ELSE 1 END") // 'unread' lên trước, 'read' xuống dưới
            ->orderBy('created_at', 'desc') // Sau đó sắp xếp theo thời gian (mới nhất trước)
            ->get();
    
        return view('notification.view_notification', compact('notifications'));
    }
    
    

    public function detail(string $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->status = 'read';
        $notification->save(); // Lưu lại thay đổi
        return view('notification.detail_notification', compact('notification'));
    }

   
}
