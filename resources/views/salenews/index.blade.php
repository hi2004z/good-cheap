@extends('layouts.client_layout')


@section('content')
<main class="main">

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">New</a></li>
                <li class="breadcrumb-item active" aria-current="page">View news status</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row d-flex justify-content-Start">
                    <div class="col col-md-9 col-lg-7 col-xl-6">
                        <div style="width:  fit-content;min-width:460px; ">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        @if (auth()->user()->image_user)
                                        <img src="{{ asset(auth()->user()->image_user) }}"
                                            alt="Generic placeholder image" class="img-fluid" style="width: 120px;  border-radius: 10px;">
                                        @else
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                            alt="Generic placeholder image" class="img-fluid" style="width: 120px;  border-radius: 10px;">
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1">{{ auth()->user()->full_name }}</h5>

                                        <p style="color: #ff0000;"><i class="fa-solid fa-face-smile" style="color: #FFD43B;"></i> Become a partner for easier management </p>
                                        <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary  " style="width: fit-content">
                                            <div>
                                                <p class="small text-muted"><i class="fa-solid fa-clock" style="color: #74C0FC;"></i> {{ auth()->user()->created_at->format('d-m-Y H:i:s') }}</p>
                                                {{-- <p class="small text-muted "><i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> 56</p> --}}
                                                <p class="small text-muted "> <i class="fa-solid fa-file-invoice-dollar" style="color: #74C0FC;"></i> {{$transactionCount}}</p>

                                            </div>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="tabs-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-5-tab" data-toggle="tab" href="#tab-5" role="tab"
                                aria-controls="tab-5" aria-selected="true">NOW SHOWING ({{ $count_now_showing }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-6-tab" data-toggle="tab" href="#tab-6" role="tab"
                                aria-controls="tab-6" aria-selected="false">PENDING APPROVAL
                                ({{ $count_pending_approval }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-7-tab" data-toggle="tab" href="#tab-7" role="tab"
                                aria-controls="tab-7" aria-selected="false">NOT ACCEPTED ({{ $count_not_accepted }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-8-tab" data-toggle="tab" href="#tab-8" role="tab"
                                aria-controls="tab-8" aria-selected="false">ITEM IS SOLD ({{ $count_hidden }})</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-content-border" id="tab-content-2">
                        <div class="tab-pane fade active show" id="tab-5" role="tabpanel"
                            aria-labelledby="tab-5-tab">


                            @foreach ($list_now_showing as $item)
                            <div class="products mb-3">
                                <div class="product product-list">
                                    <div class="row">
                                        <div class="col-5 col-lg-2">
                                            <figure class="product-media">


                                                <img src="{{ asset($item->firstImage->image_name) }}" style="width: 180px;   alt=" Product image" class="product-image">
                                            </figure><!-- End .product-media -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-6 col-lg-4 order-lg-last">
                                            <div class="product-list-action">
                                                <div class="product-price">
                                                    ${{ $item->price }}
                                                </div><!-- End .product-price -->



                                                <a href="{{ route('salenew.detail', $item->sale_new_id) }}" class="mb-1 btn btn-outline-primary btn-rounded" style="width: 100%"><i class="fa-solid fa-eye" style="color: #74C0FC;"></i> <span>Detail</span></a>
                                                <a href="{{ route('sl.confirmedSale', $item->sale_new_id) }}" men class="mb-1 btn btn-outline-primary btn-rounded" style="width: 100%"> <i class="fa-solid fa-check" style="color: #74C0FC;"></i><span>Sold</span></a>
                                                @if ($item->vip_package_id == null)
                                                <a href="{{ route('salenew.promote', $item->sale_new_id) }}" class="btn btn-primary btn-rounded" style="width: 100%"> <i class="fa-solid fa-file-invoice-dollar"></i><span>Push to the top</span></a>
                                                @endif
                                            </div><!-- End .product-list-action -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-lg-6">
                                            <div class="product-body product-action-inner">

                                                <div class="product-cat">
                                                    <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title">{{ $item->title }}
                                                    @if ($item->vip_package_id)
                                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                    @endif
                                                </h3><!-- End .product-title -->

                                                <div class="product-content">
                                                    <p><i class="fa-solid fa-crown " style="color: #FFD43B;"></i>
                                                        @if ($item->vip_package_id)
                                                        {{ $item->vipPackage->name }}
                                                        @else
                                                        No service yet
                                                        @endif

                                                    </p>

                                                    <p><i class="fa-solid fa-eye" style="color: #74C0FC;"></i> {{ $item->views }}</p>
                                                    <p><i class="fa-solid fa-clock" style="color: #74C0FC;"></i> {{ $item->created_at }}</p>
                                                    <p><i class="fa-solid fa-location-dot" style="color: #74C0FC;"></i> {{ $item->address }}</p>
                                                </div><!-- End .product-content -->


                                            </div><!-- End .product-body -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div>

                            </div>
                            @endforeach




                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="tab-6-tab">



                            @foreach ($list_pending_approval as $item)
                            <div class="products mb-3">
                                <div class="product product-list">
                                    <div class="row">
                                        <div class="col-5 col-lg-2">
                                            <figure class="product-media">


                                                <img src="{{ asset($item->firstImage->image_name) }}" style="width: 180px;   alt=" Product image" class="product-image">
                                            </figure><!-- End .product-media -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-6 col-lg-4 order-lg-last">
                                            <div class="product-list-action">
                                                <div class="product-price">
                                                    $ {{ $item->price }}
                                                </div><!-- End .product-price -->



                                                <a href="{{ route('salenew.detail', $item->sale_new_id) }}" class="mb-1 btn btn-outline-primary btn-rounded" style="width: 100%"><i class="fa-solid fa-eye" style="color: #74C0FC;"></i> <span>Detail</span></a>
                                                @if ($item->vip_package_id == null)
                                                <a href="{{ route('salenew.promote', $item->sale_new_id) }}" class="btn btn-primary btn-rounded" style="width: 100%"> <i class="fa-solid fa-file-invoice-dollar"></i><span>Push to the top</span></a>
                                                @endif
                                            </div><!-- End .product-list-action -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-lg-6">
                                            <div class="product-body product-action-inner">

                                                <div class="product-cat">
                                                    <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title">{{ $item->title }}
                                                    @if ($item->vip_package_id)
                                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                    @endif
                                                </h3><!-- End .product-title -->

                                                <div class="product-content">
                                                    <p><i class="fa-solid fa-crown " style="color: #FFD43B;"></i>
                                                        @if ($item->vip_package_id)
                                                        {{ $item->vipPackage->name }}
                                                        @else
                                                        No service yet
                                                        @endif

                                                    </p>

                                                    <p><i class="fa-solid fa-eye" style="color: #74C0FC;"></i> {{ $item->views }}</p>
                                                    <p><i class="fa-solid fa-clock" style="color: #74C0FC;"></i> {{ $item->created_at }}</p>
                                                    <p><i class="fa-solid fa-location-dot" style="color: #74C0FC;"></i> {{ $item->address }}</p>
                                                </div><!-- End .product-content -->


                                            </div><!-- End .product-body -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div>

                            </div>
                            @endforeach



                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="tab-7" role="tabpanel" aria-labelledby="tab-7-tab">

                            @foreach ($list_not_accepted as $item)
                            <div class="products mb-3">
                                <div class="product product-list">
                                    <div class="row">
                                        <div class="col-5 col-lg-2">
                                            <figure class="product-media">


                                                <img src="{{ asset($item->firstImage->image_name) }}" style="width: 180px;   alt=" Product image" class="product-image">
                                            </figure><!-- End .product-media -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-6 col-lg-4 order-lg-last">
                                            <div class="product-list-action">
                                                <div class="product-price">
                                                    $ {{ $item->price }}
                                                </div><!-- End .product-price -->



                                                <a href="{{ route('salenew.detail', $item->sale_new_id) }}" class="mb-1 btn btn-outline-primary btn-rounded" style="width: 100%"><i class="fa-solid fa-eye" style="color: #74C0FC;"></i> <span>Detail</span></a>
                                                @if ($item->vip_package_id == null)
                                                <a href="{{ route('salenew.promote', $item->sale_new_id) }}" class="btn btn-primary btn-rounded" style="width: 100%"> <i class="fa-solid fa-file-invoice-dollar"></i><span>Push to the top</span></a>
                                                @endif
                                            </div><!-- End .product-list-action -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-lg-6">
                                            <div class="product-body product-action-inner">

                                                <div class="product-cat">
                                                    <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title">{{ $item->title }}
                                                    @if ($item->vip_package_id)
                                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                    @endif
                                                </h3><!-- End .product-title -->

                                                <div class="product-content">
                                                    <p><i class="fa-solid fa-crown " style="color: #FFD43B;"></i>
                                                        @if ($item->vip_package_id)
                                                        {{ $item->vipPackage->name }}
                                                        @else
                                                        No service yet
                                                        @endif

                                                    </p>

                                                    <p><i class="fa-solid fa-eye" style="color: #74C0FC;"></i> {{ $item->views }}</p>
                                                    <p><i class="fa-solid fa-clock" style="color: #74C0FC;"></i> {{ $item->created_at }}</p>
                                                    <p><i class="fa-solid fa-location-dot" style="color: #74C0FC;"></i> {{ $item->address }}</p>
                                                </div><!-- End .product-content -->


                                            </div><!-- End .product-body -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div>

                            </div>
                            @endforeach




                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="tab-8" role="tabpanel" aria-labelledby="tab-8-tab">
                            @foreach ($list_hidden as $item)
                            <div class="products mb-3">
                                <div class="product product-list">
                                    <div class="row">
                                        <div class="col-5 col-lg-2">
                                            <figure class="product-media">


                                                <img src="{{ asset($item->firstImage->image_name) }}" style="width: 180px;   alt=" Product image" class="product-image">
                                            </figure><!-- End .product-media -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-6 col-lg-4 order-lg-last">
                                            <div class="product-list-action">
                                                <div class="product-price">
                                                    $ {{ $item->price }}
                                                </div><!-- End .product-price -->



                                                <a href="{{ route('salenew.detail', $item->sale_new_id) }}" class="mb-1 btn btn-outline-primary btn-rounded" style="width: 100%"><i class="fa-solid fa-eye" style="color: #74C0FC;"></i> <span>Detail</span></a>

                                            </div><!-- End .product-list-action -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-lg-6">
                                            <div class="product-body product-action-inner">

                                                <div class="product-cat">
                                                    <a href="#">{{ $item->sub_category->name_sub_category }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title">{{ $item->title }}
                                                    @if ($item->vip_package_id)
                                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                    @endif
                                                </h3><!-- End .product-title -->

                                                <div class="product-content">
                                                    <p><i class="fa-solid fa-crown " style="color: #FFD43B;"></i>
                                                        @if ($item->vip_package_id)
                                                        {{ $item->vipPackage->name }}
                                                        @else
                                                        No service yet
                                                        @endif

                                                    </p>

                                                    <p><i class="fa-solid fa-eye" style="color: #74C0FC;"></i> {{ $item->views }}</p>
                                                    <p><i class="fa-solid fa-clock" style="color: #74C0FC;"></i> {{ $item->created_at }}</p>
                                                    <p><i class="fa-solid fa-location-dot" style="color: #74C0FC;"></i> {{ $item->address }}</p>
                                                </div><!-- End .product-content -->


                                            </div><!-- End .product-body -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div>

                            </div>
                            @endforeach


                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div>
            </div>
        </div>

    </div>


</main><!-- End .main -->

<style>
    .listing-card {
        /* background: #d7d7d756; */
        /* border-radius: 8px; */
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        /* padding: 20px; */
        /* width: 300px; */
    }

    .card-content {
        border-radius: 8px 1px;
        background: #efeeee61;
        text-align: left;
    }

    .card-content h2 {
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .card-content .price {
        font-size: 1.5em;
        color: #e74c3c;
        margin-bottom: 10px;
    }

    .card-content .location,
    .date,
    .expiry,
    .views,
    .services {
        margin-bottom: 10px;
        color: #555;
    }

    .card-content .details,
    .renew {
        display: inline-block;
        margin-right: 10px;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .card-content .renew {
        background-color: #28a745;
    }

    .card-content .details:hover,
    .renew:hover {
        background-color: #0056b3;
    }

    .page-content {
        /* max-width: 1px; */
        margin: 0 auto;
        padding-left: 20px;
    }

    .profile {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile img {
        border-radius: 80%;
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .profile span {
        font-size: 1.2em;
        margin-right: auto;
    }

    .create-store-btn {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .illustration img {
        width: 100px;
        height: auto;
    }
</style>
@endsection