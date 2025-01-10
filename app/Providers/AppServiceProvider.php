<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Channel;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Thiết lập ngôn ngữ dựa trên session
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        // Floating-notifications
        $jsonPath = public_path('admin/js/notification.json');
        $jsonData = json_decode(file_get_contents($jsonPath), true);
        $notification = $jsonData['Floating-notifications'] ?? null;
        View::share('floating_notifications', $notification);
        // End Floating-notifications

        // Embed source code
        $filePath = public_path('admin/js/seo.json');
        $scripts = [];
        if (file_exists($filePath)) {
            $scripts = json_decode(file_get_contents($filePath), true);
        }
        // dd($scripts);
        View::share('scripts_seo', $scripts);
        // End Embed source code

        Paginator::useBootstrap();

        $setting = Setting::first() ?? new Setting();
        $categories = Category::with(['subCategories' => function ($query) {
            $query->where('status', 1);
        }])
            ->where('status', 1)
            ->where('is_delete', '0')
            ->get();

        View::share([
            'setting' => $setting,
            'categories' => $categories,
        ]);

        View::composer('*', function ($view) {
            // Loại trừ các view trong thư mục admin
            if (str_starts_with($view->getName(), 'admin')) {
                return; // Không chia sẻ biến với view admin
            }

            // Lấy tất cả các thông báo công khai
            $notifications_userid = Notification::where('status', 'public')->get();
            $notification_web = Notification::where('type', 'website')->get();

            // ID của người dùng hiện tại
            $userId = Auth::check() ? Auth::user()->user_id : null;

            // Lọc thông báo theo user_id
            $filteredNotifications = $notifications_userid->filter(function ($notification) use ($userId) {
                $selectedUsers = json_decode($notification->selected_users, true);
                return in_array($userId, $selectedUsers);
            });

            // Kết hợp và sắp xếp theo ngày
            $mergedNotifications = $filteredNotifications->merge($notification_web)
                ->sortByDesc('created_at')
                ->toArray();

            $view->with(['notifications' => $mergedNotifications]);
        });
    }
}
