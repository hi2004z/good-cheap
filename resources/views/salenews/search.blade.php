@extends('layouts.client_layout') @section('content')

    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Search</li>
                </ol>
            </div>
        </nav>
        {{-- {{ dd($vipSaleNews->user->created_at) }} --}}

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-2 col-xl-4-5col px-3">
                        <div class="mb-2"></div>
                        <!-- End .mb-2 -->

                        <h2 class="title title-border">Top Sale News</h2>
                        <!-- End .title -->

                        <div class="owl-carousel owl-simple owl-nav-top carousel-equal-height carousel-with-shadow owl-loaded owl-drag"
                            data-toggle="owl"
                            data-owl-options='{
 
                                "nav": true,
                                "dots": false,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>
                            @if ($recentVipSaleNews->isNotEmpty() || $olderVipSaleNews->isNotEmpty())
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-237px, 0px, 0px); transition: all; width: 1188px;">
                                        @foreach ($recentVipSaleNews as $item)
                                            <div class="owl-item" style="width: 217.6px; margin-right: 20px;">
                                                <div class="product">
                                                    <figure class="product-media">

                                                        <a href="salenew-detail/{{ $item->sale_new_id }}">
                                                            @if ($item->images->isNotEmpty())
                                                                <img src="{{ $item->images->first()->image_name }}"
                                                                    alt="Image" class="equal-height-image">
                                                            @endif
                                                        </a>
                                                        <div class="product-action-vertical">

                                                            <!-- Thêm data-product-id để lưu id sản phẩm -->
                                                            <form action="{{ route('addToWishlist') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="sale_new_id"
                                                                    value="{{ $item->sale_new_id }}">
                                                                <button type="submit"
                                                                    class="add-wishlist rounded-circle add-to-wishlist-btn {{ $item->isFavorited ? 'text-white bg-primary' : 'text-primary' }}"
                                                                    title="{{ $item->isFavorited ? 'Added to wishlist' : 'Add to wishlist' }}">
                                                                    <i
                                                                        class="{{ $item->isFavorited ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                                                </button>
                                                            </form>


                                                        </div>
                                                    </figure>
                                                    <div class="product-body">
                                                        <div class="product-cat">
                                                            <a
                                                                href="#">{{ $item->categoryToSubcategory->name_category }}</a>
                                                        </div>
                                                        <h3 class="product-title text-truncate-3">
                                                            <a
                                                                href="salenew-detail/{{ $item->sale_new_id }}">{{ $item->title }}</a>
                                                        </h3>
                                                        <div class="product-price">
                                                            ${{ number_format($item->price, 2) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach ($olderVipSaleNews as $item)
                                            <div class="owl-item" style="width: 217.6px; margin-right: 20px;">
                                                <div class="product">
                                                    <figure class="product-media">

                                                        <a href="salenew-detail/{{ $item->sale_new_id }}">
                                                            @if ($item->images->isNotEmpty())
                                                                <img src="{{ $item->images->first()->image_name }}"
                                                                    alt="Image" class="equal-height-image">
                                                            @endif
                                                        </a>
                                                        <div class="product-action-vertical">

                                                            <!-- Thêm data-product-id để lưu id sản phẩm -->
                                                            <form action="{{ route('addToWishlist') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="sale_new_id"
                                                                    value="{{ $item->sale_new_id }}">
                                                                <button type="submit"
                                                                    class="add-wishlist rounded-circle add-to-wishlist-btn {{ $item->isFavorited ? 'text-white bg-primary' : 'text-primary' }}"
                                                                    title="{{ $item->isFavorited ? 'Added to wishlist' : 'Add to wishlist' }}">
                                                                    <i
                                                                        class="{{ $item->isFavorited ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                                                </button>
                                                            </form>


                                                        </div>
                                                    </figure>
                                                    <div class="product-body">
                                                        <div class="product-cat">
                                                            <a
                                                                href="#">{{ $item->categoryToSubcategory->name_category }}</a>
                                                        </div>
                                                        <h3 class="product-title text-truncate-3">
                                                            <a
                                                                href="salenew-detail/{{ $item->sale_new_id }}">{{ $item->title }}</a>
                                                        </h3>
                                                        <div class="product-price">
                                                            ${{ number_format($item->price, 2) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Hiển thị owl-nav nếu có sản phẩm -->
                                <div class="owl-nav">
                                    <button type="button" role="presentation" class="owl-prev" style="left: -20px; ">
                                        <i class="icon-angle-left"></i>
                                    </button>
                                    <button type="button" role="presentation" class="owl-prev disabled"
                                        style="left: -20px; ">
                                        <i class="icon-angle-left"></i>
                                    </button>
                                </div>
                            @endif

                            <style>
                                .text-truncate-3 {
                                    display: -webkit-box;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    line-height: 1.2em;
                                    /* Adjust as needed */
                                    max-height: 3.6em;
                                    /* 1.2em * 3 lines */
                                }

                                .image-container {
                                    width: 100%;
                                    height: 200px;
                                    /* Đặt chiều cao cố định cho khung chứa */
                                    overflow: hidden;
                                    /* Đảm bảo không có phần thừa nào bị hiển thị */
                                }

                                .equal-height-image {
                                    height: 200px;
                                    /* Đặt chiều cao cố định cho tất cả các ảnh */
                                    width: 100%;
                                    /* Đảm bảo ảnh chiếm toàn bộ chiều rộng của khung chứa */
                                    object-fit: cover;
                                    /* Đảm bảo ảnh phủ kín khung mà không bị méo */
                                }

                                .owl-simple .owl-nav .owl-prev {
                                    left: -20px
                                }
                            </style>

                            <div class="owl-dots disabled"></div>
                        </div>
                        <!-- End .owl-carousel -->

                        <div class="mb-4"></div>
                        <!-- End .mb-4 -->

                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    {{ $totalNonVipSaleNews }} Products found
                                </div>
                                <!-- End .toolbox-info -->
                            </div>
                            <!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="popularity" selected="selected">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- End .toolbox-sort -->
                            </div>
                            <!-- End .toolbox-right -->
                        </div>
                        <!-- End .toolbox -->

                        <div class="products mb-3">
                            <div class="row">
                                @forelse ($nonVipSaleNews as $item)
                                    <div class="col-6 col-md-4 col-xl-3">
                                        <div class="product">
                                            <figure class="product-media">

                                                <a href="salenew-detail/{{ $item->sale_new_id }}">
                                                    @if ($item->images->isNotEmpty())
                                                        <img src="{{ $item->images->first()->image_name }}"
                                                            alt="Image" class="equal-height-image">
                                                    @else
                                                        <img src="/path/to/default-image.jpg" alt="Default Image"
                                                            class="equal-height-image">
                                                    @endif
                                                </a>
                                                <div class="product-action-vertical">

                                                    <!-- Thêm data-product-id để lưu id sản phẩm -->
                                                    <form action="{{ route('addToWishlist') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="sale_new_id"
                                                            value="{{ $item->sale_new_id }}">
                                                        <button type="submit"
                                                            class="add-wishlist rounded-circle add-to-wishlist-btn {{ $item->isFavorited ? 'text-white bg-primary' : 'text-primary' }}"
                                                            title="{{ $item->isFavorited ? 'Added to wishlist' : 'Add to wishlist' }}">
                                                            <i
                                                                class="{{ $item->isFavorited ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                                        </button>
                                                    </form>


                                                </div>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    @if ($item->categoryToSubcategory)
                                                        <a
                                                            href="#">{{ $item->categoryToSubcategory->name_category }}</a>
                                                    @else
                                                        <span>Uncategorized</span>
                                                    @endif
                                                </div>
                                                <h3 class="product-title text-truncate-3">
                                                    <a
                                                        href="salenew-detail/{{ $item->sale_new_id }}">{{ $item->title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    ${{ number_format($item->price, 2) }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p>No products found.</p>
                                    </div>
                                @endforelse
                            </div>
                            <?php $currentUrl = url()->full(); ?>

                            @if ($nonVipSaleNews->hasPages())
                                <ul class="pagination justify-content-center">

                                    {{-- Nút Previous --}}
                                    @if ($nonVipSaleNews->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link page-link-prev" href="#" aria-label="Previous"
                                                tabindex="-1" aria-disabled="true">
                                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link page-link-prev" href="{{ $currentUrl . '&page=1' }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Các số trang --}}
                                    @foreach ($nonVipSaleNews->getUrlRange(1, $nonVipSaleNews->lastPage()) as $page => $url)
                                        {{-- {{ dd($url) }} --}}
                                        @if ($page == $nonVipSaleNews->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <a class="page-link" href="#">{{ $page }}</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $currentUrl . '&page=' . $page }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Hiển thị tổng số trang --}}
                                    <li class="page-item-total">of {{ $nonVipSaleNews->lastPage() }}</li>

                                    {{-- Nút Next --}}
                                    {{-- @if ($nonVipSaleNews->hasMorePages()) --}}

                                    @php
                                        $nextPage = $nonVipSaleNews->currentPage() + 1; // Trang tiếp theo
                                    @endphp

                                    @if ($nonVipSaleNews->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link page-link-next"
                                                href="{{ $currentUrl . '&page=' . $nextPage }}" aria-label="Next">
                                                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link page-link-next" href="#" aria-label="Next"
                                                tabindex="-1" aria-disabled="true">
                                                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            @endif

                            <!-- End .row -->
                        </div>
                        <!-- End .products -->

                    </div>
                    <!-- End .col-lg-9 -->

                    <aside class="col-lg-3 col-xl-5col order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <form method="GET" action="{{ route('search') }}">
                                <!-- Filter by Address -->
                                <input type="hidden" name="keyword" value="{{ request()->get('keyword') }}">
                                {{-- <input type="hidden" id="selectedCity" name="selectedCity"> --}}

                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-6" role="button" aria-expanded="true"
                                            aria-controls="widget-6">
                                            Address
                                        </a>
                                    </h3>
                                    <input type="hidden" id="selectedCity" name="selectedCity">
                                    <div class="collapse show" id="widget-6">
                                        <div class="widget-body">
                                            <select class="form-control" id="city">
                                                <option id="selectedCity" name="address"
                                                    value="{{ request()->get('selectedCity') }}" selected>Chọn tỉnh thành
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter by Category -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"
                                            aria-controls="widget-2">
                                            Category
                                        </a>
                                    </h3>
                                    <div class="collapse show" id="widget-2">
                                        <div class="widget-body">
                                            <select class="form-select form-control" name="category">
                                                <option value="">Select Category</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->category_id }}"
                                                        {{ request()->get('category') == $item->category_id ? 'selected' : '' }}>
                                                        {{ $item->name_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter by Price -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title">
                                        <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                            aria-controls="widget-5">
                                            Price
                                        </a>
                                    </h3>
                                    <div class="collapse show" id="widget-5">
                                        <div class="widget-body">
                                            <div class="filter-price">
                                                <div class="filter-price-text">
                                                    Price Range:
                                                    <span id="filter-price-range">
                                                        ${{ request()->get('minPrice', 0) }} -
                                                        ${{ request()->get('maxPrice', $maxPriceRange) }}
                                                    </span>
                                                </div>
                                                <div id="price-slider"></div>
                                                <input type="hidden" id="minPrice" name="minPrice"
                                                    value="{{ request()->get('minPrice', 0) }}">
                                                <input type="hidden" id="maxPrice" name="maxPrice"
                                                    value="{{ request()->get('maxPrice', $maxPriceRange) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden input to retain search keyword -->

                                <!-- Apply Filters Button -->
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </form>





                        </div>
                        <!-- End .sidebar sidebar-shop -->
                    </aside>
                    <!-- End .col-lg-3 -->
                </div>
            </div>

        </div>
    </main>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const host = "https://provinces.open-api.vn/api/";


        const fetchCities = () => {
            axios.get(host + '?depth=1')
                .then(response => {
                    const cities = response.data;
                    renderCities(cities);
                })
                .catch(error => {
                    console.error("Lỗi khi gọi API Tỉnh/Thành:", error);
                });
        };

        const renderCities = (cities) => {
            let options = '<option value="" selected>Select</option>';
            cities.forEach(city => {
                options +=
                    `<option data-id="${city.code}" value="${city.name}" ${city.name === "<?php echo $_GET['selectedCity']; ?>" ? 'selected' : ''}>${city.name}</option>`;

                // options += `<option data-id="${city.code}" value="${city.name}">${city.name}</option>`;
            });
            document.querySelector("#city").innerHTML = options;
        };

        const handleCityChange = () => {
            const selectedOption = document.querySelector("#city option:checked");
            const cityName = selectedOption.value;
            document.querySelector("#selectedCity").value = cityName;

            if (cityName) {
                console.log(`${cityName}`);
            } else {
                console.log("Chưa chọn Tỉnh/Thành.");
            }
        };

        fetchCities();

        document.querySelector("#city").addEventListener("change", handleCityChange);
    </script>


    <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/ajax_wishlist.js') }}"></script>

    <script>
        var userId = "{{ Auth::check() ? Auth::user()->user_id : '' }}";
        // Hiển thị thông báo sau khi load trang nếu có từ session
        @if (session('alert'))
            Swal.fire({
                icon: "{{ session('alert')['type'] }}",
                title: "{{ session('alert')['message'] }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        $(document).ready(function() {

            console.log(123);

            // Slider For category pages / filter price
            if (typeof noUiSlider === 'object') {
                var priceSlider = document.getElementById('price-slider');

                // Check if #price-slider elem is exists if not return
                // to prevent error logs
                if (priceSlider == null) return;

                noUiSlider.create(priceSlider, {
                    start: [0, <?php echo $maxPriceRange; ?>],
                    connect: true,
                    step: 50,
                    margin: 200,
                    range: {
                        'min': 0,
                        'max': <?php echo $maxPriceRange; ?>
                    },
                    tooltips: true,
                    format: wNumb({
                        decimals: 0,
                        prefix: '$'
                    })
                });

                // Update Price Range
                priceSlider.noUiSlider.on('update', function(values, handle) {
                    // Update visible price range text
                    $('#filter-price-range').text(values.join(' - '));

                    // Select hidden inputs
                    const minInput = document.getElementById('minPrice');
                    const maxInput = document.getElementById('maxPrice');

                    // Remove the "$" symbol from the slider values
                    const minValue = values[0].replace('$', '');
                    const maxValue = values[1].replace('$', '');

                    // Update hidden inputs with the cleaned slider values
                    if (minInput && maxInput) {
                        minInput.value = minValue; // Set the minimum value
                        maxInput.value = maxValue; // Set the maximum value
                    }

                    console.log(typeof(minValue));
                    console.log(typeof(maxValue));

                    console.log('Min Value:', minValue);
                    console.log('Max Value:', maxValue);
                });
            }
        })
    </script>
@endsection
