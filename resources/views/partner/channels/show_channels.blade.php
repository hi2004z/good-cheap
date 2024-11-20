@extends('layouts.client_layout')

@section('content')
<style>
    .channel-info {
        display: flex;
        align-items: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 15px;
        background-color: #f9f9f9;
        margin: 20px auto;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .channel-info:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .channel-info img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 20px;
        transition: transform 0.3s ease;
    }

    .channel-info img:hover {
        transform: scale(1.1);
    }

    .channel-name {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .channel-username {
        font-size: 16px;
        color: #888;
        margin-bottom: 10px;
    }

    .channel-stats {
        color: #555;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .channel-stats span {
        margin-right: 15px;
    }

    .channel-actions {
        margin-left: auto;
    }

    .channel-actions a {
        border-radius: 25px;
        padding: 8px 20px;
        font-size: 14px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        display: inline-block;
    }

    .channel-actions a:hover {
        background-color: #0056b3;
    }

    .channel-actions .btn-danger:hover {
        background-color: #d9534f;
    }

    .stats-info {
        font-size: 14px;
        color: #e84e40;
        display: flex;
        align-items: center;
    }

    .stats-info i {
        margin-right: 5px;
    }

    .heading .title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .heading-right .title-link {
        font-size: 16px;
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .heading-right .title-link:hover {
        text-decoration: underline;
    }

    .sale-card {
        border: 1px solid #ddd;
        border-radius: 15px;
        background-color: #f9f9f9;
        margin: 15px 0;
        padding: 15px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .sale-card .title {
        font-size: 18px;
        font-weight: bold;
    }

    .sale-card .price {
        color: #e84e40;
        font-size: 16px;
        font-weight: bold;
    }

    .sale-card .description {
        color: #555;
        font-size: 14px;
    }

    .sale-card .status {
        font-size: 14px;
        color: #888;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

<main class="container mb-5">
    
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Channel</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="channel-info">
                <!-- Channel Image -->
                <img src="{{ asset('storage/' . ($channels->image_channel ?? 'assets/images/image.png')) }}" alt="{{ $channels->name_channel }}" class="rounded-circle me-3">
                <!-- Channel Details -->
                <div class="flex-grow-1">
                    <div class="channel-name">{{ $channels->name_channel }}</div>
                    <div class="channel-username">{{ $channels->username }}</div>
                    <div class="channel-stats">
                        <span>Người theo dõi: 20 {{ $channels->followers_count }}</span>
                        <span>Sales news: {{ $NewsCount }}</span>
                        <span>Ngày tạo: {{ $channels->created_at->format('d/m/Y') }}</span>

                    </div>
                </div>
                <div class="channel-actions">
                    <a href="#" class="btn btn-primary btn-sm">Follow </a>
                </div>
            </div>
        </div>

        <div class="container for-you">
            <!-- Sales News -->
            <main class="main">
           
    
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="toolbox">
                                    <div class="toolbox-left">
                                        <div class="toolbox-info">
                                            Showing <span>9 of 56</span> Products
                                        </div><!-- End .toolbox-info -->
                                    </div><!-- End .toolbox-left -->
    
                                    <div class="toolbox-right" style=" visibility: hidden;">
                                        <div class="toolbox-sort">
                                            <div class="select-custom">
                                                <select name="sortby" id="sortby" class="form-control">
                                                    <option value="date">Date</option>
                                                </select>
                                            </div>
                                        </div><!-- End .toolbox-sort -->
                                        
                                    </div><!-- End .toolbox-right -->
                                </div><!-- End .toolbox -->
    
                                <div class="products mb-3">
                                @foreach ($sale_news as $sale_new)

                                    <div class="product product-list">
                                        <div class="row">
                                            <div class="col-6 col-lg-3">
                                                <figure class="product-media">
                                                    @if($sale_new->vip_pakage_id != null)
                                                    <span class="product-label label-new">
                                                        On top
                                                    </span>
                                                @endif
                                                    <a href="product.html">
                                                        <img src="/assets/images/products/product-4.jpg" alt="Product image1" class="product-image">
                                                    </a>
                                                </figure><!-- End .product-media -->
                                            </div><!-- End .col-sm-6 col-lg-3 -->
    
                                            <div class="col-6 col-lg-3 order-lg-last">
                                                <div class="product-list-action">
                                                    <div class="product-price" >
                                                        <h4 class="text-primary">{{ $sale_new ->price  }} $</h4>
                                                    </div><!-- End .product-price -->
                                                   
                                                    <div class="product-actions">
                                                        <a href="#" class="btn btn-light mb-2" title="Add to Wishlist">
                                                            <i class="fas fa-heart"></i> Wishlist
                                                        </a>
                                                        <a href="#" class="btn btn-primary">
                                                            <i class="fas fa-info-circle"></i> Details
                                                        </a>
                                                    </div>
                                                </div><!-- End .product-list-action -->
                                            </div><!-- End .col-sm-6 col-lg-3 -->
    
                                            <div class="col-lg-6">
                                                <div class="product-body product-action-inner">
                                                    <div class="product-cat">
                                                        <a href="#">{{ $sale_new->name_sub_category }}</a>
                                                    </div><!-- End .product-cat -->
                                                    <h3 class="product-title"><a href="product.html">{{ $sale_new -> title }}</a></h3><!-- End .product-title -->
    
                                                    <div class="product-content wrap">
                                                        <p>{{ $sale_new -> description }}</p>
                                                    </div><!-- End .product-content -->
                                                    
                                                    <div class="product-description">
                                                        <p><i class="fas fa-map-marker-alt"></i> {{ $sale_new->channels->address }}</p>
                                                        <p><i class="fas fa-calendar-alt"></i>  {{ $sale_new->created_at }}</p>
                               
                                                    </div><!-- End .product-nav -->
                                                </div><!-- End .product-body -->
                                            </div><!-- End .col-lg-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .product -->
                                    @endforeach
    
                         
    
                                </div><!-- End .products -->
    
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                        <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item-total">of 6</li>
                                        <li class="page-item">
                                            <a class="page-link page-link-next" href="#" aria-label="Next">
                                                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3 order-lg-first">
                                <div class="sidebar sidebar-shop">
                                    <div class="widget widget-clean">
                                        <label>Filters:</label>
                                        <a href="#" class="sidebar-filter-clear">Clean All</a>
                                    </div><!-- End .widget widget-clean -->
    
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                                Category
                                            </a>
                                        </h3><!-- End .widget-title -->
                                        <div class="collapse show" id="widget-1">
                                            <div class="widget-body">
                                                <div class="filter-items filter-items-count">
                                                    @foreach($subcategory_count as $name => $count)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="{{ Str::slug($name) }}" value="{{ $name }}">
                                                            <label class="custom-control-label" for="{{ Str::slug($name) }}">
                                                                <p>{{ $name }}</p>
                                                            </label>
                                                        </div><!-- End .custom-checkbox -->
                                                        <span class="item-count">{{ $count }}</span>
                                                    </div><!-- End .filter-item -->
                                                @endforeach
                                                
                                                </div><!-- End .filter-items -->
                                            </div><!-- End .widget-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .widget -->
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                                Brand
                                            </a>
                                        </h3><!-- End .widget-title -->
    
                                        <div class="collapse show" id="widget-4">
                                            <div class="widget-body">
                                                <div class="filter-items">
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="brand-7">
                                                            <label class="custom-control-label" for="brand-7">Nike</label>
                                                        </div><!-- End .custom-checkbox -->
                                                    </div><!-- End .filter-item -->
    
                                                </div><!-- End .filter-items -->
                                            </div><!-- End .widget-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .widget -->
    
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title">
                                            <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                                Price
                                            </a>
                                        </h3><!-- End .widget-title -->
    
                                        <div class="collapse show" id="widget-5">
                                            <div class="widget-body">
                                                <div class="filter-price">
                                                    <div class="filter-price-text">
                                                        Price Range:
                                                        <span id="filter-price-range"></span>
                                                    </div><!-- End .filter-price-text -->
    
                                                    <div id="price-slider"></div><!-- End #price-slider -->
                                                </div><!-- End .filter-price -->
                                            </div><!-- End .widget-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .widget -->
                                </div><!-- End .sidebar sidebar-shop -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .page-content -->
            </main><!-- End .main -->
        </div>
    </div>
</main>

@endsection
