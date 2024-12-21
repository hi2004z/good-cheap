@extends('layouts.client_layout')


@section('content')
<main class="main ">

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url("/") }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->


        {{-- {{dd($data_salenew)}}; --}}
        <div class="page-content  ">
            <div class="cart ">
                <div class="container summary ">
                    <div class="row  pb-2">
                        <div class="col-3 col-md-2 mx-2">
                            <img class="mx-5" src="{{ asset($data_salenew->firstImage->image_name) }}" width="100px"
                                alt="">
                        </div>
                        <div class="col-7 mx-md-1 mx-5">
                            <h5>{{ $data_salenew->title }}</h5>
                            <p><i class="fa-regular fa-eye fa-xs" style="color: #74C0FC;"></i> {{ $data_salenew->views }}
                            </p>
                            <p><i class="fa-solid fa-location-dot fa-xs" style="color: #74C0FC;"></i> {{ $data_salenew->address }} </p>
                            <p>Date posted: {{ date('D, d M Y', strtotime($data_salenew->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="row  pb-2 ">
                        <div class="fo col-md-5">


                                <span id="description">{!! $data_salenew->	description !!}</span><br>


                        </div>
                        <div class="col-md-4 ">

                              @if(isset($data_json))
                                <div class="product-info fo">
                                    @foreach($data_json as $variant)
                                    <div class="product-info-item">
                                        <span class="product-info-name">
                                            {{ $variant->name }}</span>: <span class="product-info-option">{{ $variant->option }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                     @endif
                                    </div>

                                   <div class=" fo col-md-3 flex-wrap d-flex flex-row">
                                        @foreach ($data_salenew->images as $item)
                                        <img src="{{ asset($item->image_name) }}" class="m-2"  style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                        @endforeach
                                    </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

</main>
<style>
    .tv2 {
        display: flex;
        /* background-color: rgb(108, 99, 99); */
        border-radius: 2px;

    }

    .tv {
        /* background-color: rgb(182, 168, 168); */
        /* height: 500px; */
    }

    .fo {
        /* height: 40px; */
        padding: 0.85rem 2rem;
        font-size: 1.4rem;
        line-height: 1.5;
        font-weight: 300;
        color: #777;
        background-color: #fafafa;
        border: 1px solid #ebebeb;
        border-radius: 0;
        margin-bottom: 2rem;
        transition: all 0.3s;
        box-shadow: none;
    }
</style>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
