<?php

namespace App\Providers;

use App\Models\Channel;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

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

// Lấy ID của người dùng hiện tại
$userId = Auth::check() ? Auth::user()->user_id : null;

if ($userId) {
    // Lọc thông báo theo user_id và sắp xếp theo ngày (mới nhất trước)
    $notifications = DB::table('notifications')
        ->where('user_id', $userId)
        ->orderBy('created_at', 'desc') // Sắp xếp theo ngày
        ->get();
} else {
    $notifications = collect([]); // Trả về một collect trống nếu người dùng chưa đăng nhập
    
}

// Gửi dữ liệu notifications tới view
View::share('notifications', $notifications);

        });
    }
}