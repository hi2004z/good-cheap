<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        // Lấy tất cả các đơn hàng mà có sản phẩm có staff_id, không lấy sản phẩm chỉ có channel_id
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.user_id') // Kết hợp với bảng users để lấy full_name và image_user
            ->join('payment_method', 'orders.payment_method_id', '=', 'payment_method.payment_method_id') // Kết hợp với bảng payment_method để lấy name_method
            ->join('order_details', 'orders.order_id', '=', 'order_details.order_id') // Kết hợp với bảng order_details
            ->join('products', 'order_details.product_id', '=', 'products.product_id') // Kết hợp với bảng products
            ->whereNotNull('products.staff_id') // Lọc các sản phẩm có staff_id, không lấy sản phẩm chỉ có channel_id
            ->select(
                'orders.order_id',
                'orders.created_at',
                'users.full_name',
                'users.image_user',
                'users.email',
                'payment_method.name_method',
                // 'orders.status as order_status',
                'orders.name_receiver',
                'orders.price',
                'orders.phone_number',
                'orders.address',
                'products.name_product',
                'products.price as product_price',
                'order_details.status as detail_status'  // Lấy trạng thái từ bảng order_details
            )
            ->orderBy('orders.created_at', 'desc') // Sắp xếp theo ngày tạo đơn hàng mới nhất
            ->get()
            ->groupBy('order_id'); // Nhóm theo order_id để mỗi đơn hàng có một tập hợp các trạng thái của order_details

        // Sử dụng map để tạo mảng trạng thái cho mỗi đơn hàng
        $orders = $orders->map(function ($orderGroup) {
            $order = $orderGroup->first();  // Lấy thông tin đơn hàng đầu tiên

            // Lấy tất cả trạng thái từ các chi tiết đơn hàng
            $statuses = $orderGroup->pluck('detail_status');

            // Kiểm tra nếu tất cả các trạng thái đều giống nhau
            if ($statuses->unique()->count() == 1) {
                // Nếu tất cả trạng thái giống nhau, chỉ hiển thị một trạng thái
                $order->detail_status = $statuses->first();
            } else {
                // Nếu có nhiều trạng thái khác nhau, gán trạng thái là 'processing'
                $order->detail_status = 'processing';
            }

            return $order;
        });


        // dd($orders); // Kiểm tra kết quả
        return view('admin.orders.index', compact('orders'));
    }

    public function getOrderDetails($detail_order_id)
    {
        // Lấy thông tin đơn hàng từ bảng 'orders'
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->join('payment_method', 'orders.payment_method_id', '=', 'payment_method.payment_method_id')
            ->select(
                'orders.order_id',
                'orders.user_id',
                'orders.created_at',
                'orders.name_receiver',
                'orders.price',
                'orders.phone_number',
                'orders.address',
                'users.full_name',
                'users.image_user',
                'users.email',
                'payment_method.name_method'
            )
            ->where('orders.order_id', $detail_order_id)
            ->first();

        $userId = $order->user_id;
        $totalOrders = DB::table('orders')->where('user_id', $userId)->count();

        // Lấy thông tin chi tiết sản phẩm trong đơn hàng, với điều kiện staff_id có dữ liệu và channel_id = null
        $orderDetails = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.product_id')
            ->leftJoin('photo_gallery', function ($join) {
                $join->on('products.product_id', '=', 'photo_gallery.product_id')
                    ->whereRaw('photo_gallery.photo_gallery_id = (SELECT MIN(photo_gallery_id) FROM photo_gallery WHERE photo_gallery.product_id = products.product_id)');
            })
            ->leftJoin('reviews', 'order_details.detail_order_id', '=', 'reviews.detail_order_id')
            ->leftJoin('users as reviewers', 'reviews.user_id', '=', 'reviewers.user_id')
            ->leftJoin('reviews as replies', 'reviews.review_id', '=', 'replies.parent_id')
            ->select(
                'order_details.*',
                'products.name_product',
                'products.price as product_price',
                'products.description',
                'order_details.value',
                'order_details.status as detail_status',
                'order_details.is_reviewed',
                'order_details.stock',
                DB::raw('products.price * order_details.value as total_price'),
                'photo_gallery.image_name as product_image',
                'reviews.review_id',
                'reviews.content as review_content',
                'reviews.status as review_status',
                'reviews.rating as review_rating',
                'reviews.created_at as review_created_at',
                'reviewers.full_name as reviewer_name',
                'reviewers.email as reviewer_email',
                'reviewers.image_user as reviewer_avatar',
                'replies.content as reply_content', // Lấy nội dung phản hồi
                'replies.created_at as reply_created_at',
                'replies.staff_id as reply_staff_id'
            )
            ->where('order_details.order_id', $detail_order_id)
            ->whereNotNull('products.staff_id')
            ->whereNull('products.channel_id')
            ->get();
        // Tính tổng số tiền và các thông tin khác cho đơn hàng
        $subtotal = $orderDetails->sum('total_price');
        $tax = $subtotal * 0.1; // Giả sử thuế 10%
        $total = $subtotal + $tax;
        // dd($orderDetails);
        return view('admin.orders.order-detail', compact('order', 'orderDetails', 'subtotal', 'tax', 'total', 'totalOrders'));
    }






    public function updateStatus(Request $request, $detail_order_id)
    {
        $status = $request->input('status');
        // Cập nhật trạng thái trong bảng order_details
        DB::table('order_details')
            ->where('detail_order_id', $detail_order_id)
            ->update(['status' => $status]);

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái đơn hàng đã được cập nhật.',
            'new_status' => $status
        ]);
    }

    public function updateOrderStatus(Request $request, $detail_order_id)
    {
        $status = $request->input('status');
        // Cập nhật trạng thái trong bảng order_details
        DB::table('order_details')
            ->where('detail_order_id', $detail_order_id)
            ->update(['status' => $status]);

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái đơn hàng đã được cập nhật.',
            'new_status' => $status
        ]);
    }
    // public function updateOrderStatus(Request $request, $detail_order_id)
    // {
    //     $status = $request->input('status');

    //     // Cập nhật trạng thái của các sản phẩm trong order_details với điều kiện
    //     DB::table('order_details')
    //         ->join('products', 'order_details.product_id', '=', 'products.product_id')
    //         ->where('order_details.order_id', $detail_order_id)
    //         ->whereNotNull('products.staff_id')
    //         ->whereNull('products.channel_id')
    //         ->update(['order_details.status' => $status]);

    //     // Trả về JSON phản hồi thành công
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Trạng thái đơn hàng đã được cập nhật.',
    //         'new_status' => $status
    //     ]);
    // }






    public function demo()
    {
        // Lấy danh sách đơn hàng cùng thông tin người dùng và phương thức thanh toán
        $orders = DB::table('orders')
            ->join('payment_method', 'orders.payment_method_id', '=', 'payment_method.payment_method_id')
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->select('orders.*', 'payment_method.content as payment_method_name', 'users.full_name')
            ->get();

        // Lấy thông tin chi tiết cho từng order
        foreach ($orders as $order) {
            $orderDetails = DB::table('order_details AS od')
                ->select(
                    'od.*',
                    'p.name_product AS name_product',
                    'p.price',
                    'pg.image_name AS first_image', // Ảnh đầu tiên
                    'c.name_channel',
                    'c.image_channel'
                )
                ->join('products AS p', 'od.product_id', '=', 'p.product_id')
                ->leftJoin('photo_gallery AS pg', 'pg.product_id', '=', 'od.product_id')
                ->join('channels AS c', 'od.channel_id', '=', 'c.channel_id')
                ->where('od.order_id', $order->order_id) // Lấy theo `order_id` của từng đơn hàng
                ->orderBy('pg.photo_gallery_id', 'asc') // Lấy ảnh đầu tiên
                ->get();

            // Gán danh sách chi tiết sản phẩm cho từng đơn hàng
            $order->order_details = $orderDetails;
            dd($order);
        }
    }
}
// public function index()
// {
//     // Lấy danh sách đơn hàng cùng thông tin người dùng và phương thức thanh toán
//     $orders = DB::table('orders')
//         ->join('payment_method', 'orders.payment_method_id', '=', 'payment_method.payment_method_id')
//         ->join('users', 'orders.user_id', '=', 'users.user_id')
//         ->select('orders.*', 'payment_method.content as payment_method_name', 'users.full_name')
//         ->get();
//     // Lấy thông tin chi tiết cho từng order
//     foreach ($orders as $order) {
//         $orderDetails = DB::table('order_details AS od')
//             ->select(
//                 'od.*',
//                 'p.name_product AS name_product',
//                 'p.price',
//                 'pg.image_name AS first_image', // Ảnh đầu tiên
//                 'c.name_channel',
//                 'c.image_channel'
//             )
//             ->join('products AS p', 'od.product_id', '=', 'p.product_id')
//             ->leftJoin('photo_gallery AS pg', 'pg.product_id', '=', 'od.product_id')
//             ->join('channels AS c', 'od.channel_id', '=', 'c.channel_id')
//             ->where('od.order_id', $order->order_id) // Lấy theo `order_id` của từng đơn hàng
//             ->orderBy('pg.photo_gallery_id', 'asc') // Lấy ảnh đầu tiên
//             ->get();

//         // Gán danh sách chi tiết sản phẩm cho từng đơn hàng
//         $order->order_details = $orderDetails;
//     }

//     return view('admin.orders.index', compact('orders'));
// }