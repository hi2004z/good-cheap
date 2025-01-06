<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Notification;
use App\Models\SaleNews;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserFollowed;
use App\Models\VipPackage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function dashboard()
    {
        $user = Auth::user();
        $channel = Channel::where('user_id', $user->user_id)->firstOrFail();
        $currentDate = Carbon::today();
        $previousDate = Carbon::yesterday();

        // Lấy số lượng Sale News theo channel_id
        $saleCount = SaleNews::where('channel_id', $channel->channel_id)
            ->where('status', 1)
            ->where('is_delete', null)
            ->where('approved', 1)
            ->count();
        $soldnewCount =  SaleNews::where('channel_id', $channel->channel_id)
            ->where('status', 0)
            ->where('is_delete', null)
            ->where('approved', 1)
            ->count();
        $followCount = UserFollowed::where('channel_id', $channel->channel_id)->count();
        $totalViews = SaleNews::where('channel_id', $channel->channel_id)->sum('views');
        // Lấy 3 sản phẩm có nhiều lượt xem nhất
        $top3Sales = SaleNews::where('channel_id', $channel->channel_id)
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();

        // Tính tổng lượt xem
        $totalViewshot = $top3Sales->sum('views');


        return view('partner.dashboard', compact(
            'totalViews',
            'totalViewshot',
            'saleCount',
            'followCount',
            'top3Sales',
            'soldnewCount'

        ));
    }
}
