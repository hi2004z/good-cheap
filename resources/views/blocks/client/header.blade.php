<style>
    .text-ellipsis {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* Số lượng hàng hiển thị */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;

        line-height: 1.5em;
        /* Chiều cao dòng */
    }

    .main-nav {
        width: 100%;

        white-space: nowrap;
        overflow: hidden;
        box-sizing: border-box;
    }

    .main-nav span {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 10s linear infinite;
    }

    @keyframes marquee {
        from {
            transform: translate(0, 0);
        }

        to {
            transform: translate(-100%, 0);
        }
    }
</style>

<div class="page-wrapper">

    <header class="header header-intro-clearance header-4">
        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ $setting->logo ? asset($setting->logo) : asset('assets/images/demos/demo-4/logo.png') }}"
                            alt="Molla Logo" class="d-none d-sm-block" width="150" height="30">
                        <img src="{{ $setting->logo ? asset($setting->logo_mobile) : asset('assets/images/demos/demo-4/logo.png') }}"
                            alt="Molla Logo Mobile" class="d-block d-sm-none" width="55" height="17">
                    </a>
                </div>
                <!-- End .header-left -->
                <div class="header-center">
                    <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <form action="{{ route('search') }}" method="GET">
                            <!-- Search Keyword -->
                            <div class="header-search-wrapper search-wrapper-wide">
                                <label for="q" class="sr-only">Search</label>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                <input type="search" class="form-control" name="keyword" id="keyword"
                                    placeholder="Search in ..." value="{{ request()->get('keyword') }}" autofocus>
                            </div>

                            <!-- Retain Filters -->
                            <input type="hidden" name="selectedCity" value="{{ request()->get('selectedCity') }}">
                            <input type="hidden" name="category" value="{{ request()->get('category') }}">
                            <input type="hidden" name="minPrice" value="{{ request()->get('minPrice') }}">
                            <input type="hidden" name="maxPrice" value="{{ request()->get('maxPrice') }}">
                        </form>


                    </div>
                    <!-- End .header-search -->
                </div>
                <div class="header-right">
                    @if (isset(auth()->user()->user_id))
                        <div class="wishlist" style="white-space: nowrap">
                            <a href="{{ route('add.sale-news') }}" title="Wishlist">
                                <div class="icon">
                                    <i class="fa-regular fa-newspaper"></i>
                                </div>
                                <p>News Sale</p>
                            </a>
                        </div>
                        <!-- End .compare-dropdown -->
                        <div class="dropdown compare-dropdown">
                            <a href="{{ route('message.conversations') }} " class="dropdown-toggle" role="button"
                                aria-haspopup="true">
                                <div class="icon">
                                    <i class="fa-regular fa-comments"></i> <!-- Thay đổi icon ở đây -->
                                </div>
                                <p>Chat</p>
                            </a>
                        </div>
                        <!-- End .compare-dropdown -->
                        <div class="dropdown cart-dropdown">
                            <a href="{{ route('wishlist') }}" class="dropdown-toggle" data-display="static">
                                <div class="icon">
                                    <i class="fa-regular fa-heart"></i>
                                    <!-- <span class="cart-count">0</span> Số lượng sẽ được cập nhật qua AJAX -->
                                </div>
                                <p>Wishlist</p>
                            </a>
                        </div>
                        <!-- End .cart-dropdown -->
                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle d-flex align-items-center" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <div class="icon">
                                    <i class="fa-regular fa-bell fa-sm"></i>
                                </div>
                                <p>notifications</p>
                            </a>
                            <div>
                                @if ($notifications->isNotEmpty())
                                    <ul class="dropdown-menu dropdown-menu-end p-0 show border" data-bs-popper="static"
                                        style="border: 1px solid #ddd; border-radius: 5px;">
                                        <li class="dropdown-notifications-list scrollable-container"
                                            style="max-height: 200px; overflow-y: auto;">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($notifications as $notification)
                                                    <a href="{{ route('notifications.detail', ['notification' => $notification->notification_id]) }}"
                                                        class="notification-link">
                                                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read border-bottom"
                                                            style="border-bottom: 1px solid #ddd;">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-1">
                                                                        {{ Str::limit($notification->title_notification, 27) }}
                                                                    </h6>
                                                                    <h5 class="mb-0">{!! Str::limit($notification->content_notification, 40) !!}</h5>
                                                                    <small class="text-muted">
                                                                        {{ $notification->created_at }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="border-top">
                                            <div class="d-grid p-4">
                                                <a class="btn btn-primary" href="{{ route('notifications.show') }}">
                                                    <small>View all notifications</small>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="dropdown-menu dropdown-menu-end p-0 show border"
                                        data-bs-popper="static" style="border: 1px solid #ddd; border-radius: 5px;">
                                        <li class="dropdown-notifications-list text-center p-3">
                                            <span class="text-muted">No notifications available.</span>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        @else
                            <div class="wishlist">
                                <a href="{{ route('login') }}" style="font-size: 1.8rem">
                                    <div class="icon d-flex align-items-center">
                                        <i class="icon-user"></i>
                                        Login
                                    </div>
                                </a>
                            </div>
                            <div class="wishlist">
                                <a href="{{ route('register') }}" style="font-size: 1.8rem">
                                    <div class="icon d-flex align-items-center">
                                        {{-- <i class="icon-user"></i> --}}
                                        Sign Up
                                    </div>
                                </a>
                            </div>
                    @endif
                </div>
                <!-- End .header-right -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .header-middle -->
        <div class="header-bottom sticky-header">
            <div class="container">
                <div class="header-left">
                    <div class="dropdown category-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static"
                            title="Browse Categories">

                            Sub Categories <i class="icon-angle-down"></i>

                        </a>
                        <div class="dropdown-menu">
                            <nav class="side-nav">
                                <ul class="menu-vertical sf-arrows">
                                    @foreach ($categories as $category)
                                        @foreach ($category->subCategories as $subCategory)
                                            <li><a
                                                    href="{{ route('seach-category') }}?subcategory={{ $subCategory->sub_category_id }}&selectedCity={{ request()->get('selectedCity', '') }}">{{ $subCategory->name_sub_category }}</a>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                                <!-- End .menu-vertical -->
                            </nav>
                            <!-- End .side-nav -->
                        </div>
                        <!-- End .dropdown-menu -->
                    </div>
                    <!-- End .category-dropdown -->
                </div>
                <!-- End .header-left -->
                <div class="header-center">
                    <nav class="main-nav">
                        @if (!empty($floating_notifications))
                            <span>{{ $floating_notifications }}</span>
                        @else
                            <span>Welcome to Good & Cheap website wish you a great career</span>
                        @endif
                    </nav>
                    <!-- End .main-nav -->
                </div>
                <div class="header-right">
                    <div class="row">
                        @guest
                            <ul class="menu sf-arrows">
                                <li class="mx-3">
                                    <a href="{{ route('home') }}" class=""><i
                                            class="fa-solid fa-house mx-1"></i>Home</a>
                                </li>



                                <li class="mx-3">
                                    <a href="{{ route('blogs.listting') }}" class=""><i
                                            class="fa-solid fa-pen-nib mx-1"></i>Blog</a>
                                </li>


                                <li class="mx-3">
                                    <a href="{{ route('contact') }}" class=""><i
                                            class="fa-solid fa-star mx-1"></i>Contact</a>

                                </li>


                            </ul>



                        @endguest
                        @auth
                            <!-- Nếu đã đăng nhập -->
                            <ul class="menu sf-arrows">
                                <li class="mx-3">
                                    <a href="{{ route('home') }}" class=""><i
                                            class="fa-solid fa-house mx-1"></i>Home</a>
                                </li>

                                <li class="mx-3">
                                    <a href="{{ route('blogs.listting') }}" class=""><i
                                            class="fa-solid fa-pen-nib mx-1"></i>Blog</a>
                                </li>

                                <li class="mx-3">
                                    <a href="{{ route('contact') }}" class=""><i
                                            class="fa-solid fa-star mx-1"></i>contact</a>
                                </li>
                                <li class="header-dropdown">
                                    <img src="{{ Auth::user()->image_user ? asset(Auth::user()->image_user) : 'https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg' }}"
                                        alt="User Avatar" style="width: 30px; height: 30px;border-radius: 50%;"
                                        class="btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    <ul class="header-menu" style="left: 50%; transform: translateX(-50%);">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.manage') }}">
                                                {{ __('Profile') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('sl.index') }}">
                                                {{ __('Salenews Status') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.transaction_history') }}">
                                                {{ __('Transaction History') }}
                                            </a>
                                        </li>
                                        @if (!auth()->user()->channel || auth()->user()->channel->status === null)
                                            <li>
                                                <a class="dropdown-item" href="{{ url('channels/create') }}">
                                                    {{ __('Upgrage Account') }}
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->channel && auth()->user()->channel->status !== null)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('channels.index') }}">
                                                    {{ __('My Channel') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ url('partners/') }}">
                                                    {{ __('Channel Manager') }}
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <form class="from_logout" method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>


                            </ul>
                        @endauth
                    </div>
                </div>
                <!-- End .header-center -->
                <!-- End .container -->
            </div>
        </div>
        <!-- End .header-bottom -->
    </header>
    <!-- End .header -->
