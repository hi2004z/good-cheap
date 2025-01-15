@extends('layouts.client_layout')


@section('content')
 
<main class="main">

    <div class="container">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Sale news</a></li>
                <li class="breadcrumb-item active" aria-current="page">Default</li>
            </ol>

           <nav class="product-pager ml-auto" aria-label="Product">
                @if($prevNewsId)
                <a class="product-pager-link product-pager-prev" href="{{ route('salenew.detail', $prevNewsId) }}" aria-label="Previous">
                    <i class="icon-angle-left"></i>
                    <span>Prev</span>
                </a>
                @else
                <a class="product-pager-link product-pager-prev disabled" aria-label="Previous">
                    <i class="icon-angle-left"></i>
                    <span>Prev</span>
                </a>
                @endif

                @if($nextNewsId)
                <a class="product-pager-link product-pager-next" href="{{ route('salenew.detail', $nextNewsId) }}" aria-label="Next">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
                @else
                <a class="product-pager-link product-pager-next disabled" aria-label="Next">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
                @endif
            </nav><!-- End .pager-nav -->
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{ asset($new->firstImage->image_name) }} "
                                        data-zoom-image="{{ asset($new->firstImage->image_name) }}"
                                        alt="product image">
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>

                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">


                                    @foreach ($new->images as $item)
                                    <a class="product-gallery-item {{ $loop->first ? 'active' : '' }}" href="#"
                                    data-image="{{ asset($item->image_name) }}"
                                    data-zoom-image="{{ asset($item->image_name) }}">
                                    <img src="{{ asset($item->image_name) }}" alt="product side">
                                     </a>
                                    @endforeach


                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $new->title }}</h1><!-- End .product-title -->
                            <div class="product-price">
                                $ {{ number_format($new->price, 2) }}
                            </div><!-- End .product-price -->

                            <div class="product-content">
                               <p> <i class="fa-solid fa-location-dot"></i>  {{ $new->address }} </p>
                               <p> <i class="fa-solid fa-clock"></i>  <span id="time-ago"></span> </p>
                            </div><!-- End .product-content -->



                            <div class="mb-2">
                        @if(isset(auth()->user()->user_id ))


                        @if (auth()->user()->user_id != $get_user->user_id)


                            @if ($get_user->phone_number)
                            <a href="#" class="btn btn-outline-dark btn-rounded mr-4"><i class="fa-solid fa-phone"></i> {{ $get_user->phone_number }}</a>
                            @endif
                            @if(isset(auth()->user()->user_id))
                            <a id="message-id"  style="color: white" data-img="{{ $get_user->image_user ? $get_user->image_user : 'storage/images/user.jpg' }}" data-id="{{$new->user_id}}" data-name="{{ $get_user->full_name}}"  class="btn btn-primary btn-rounded"> <i class="fa-regular fa-comments"></i>  Message the seller </a>
                            @endif
                        @endif
                        @endif
                                </div>



                            @if(!is_null($new->channel_id))


                            <div class="product-details-footer">
                                <div class="container summary">

                                <div class="row  px-4">
                                    <div class="col-2">

                                        <img src="{{ asset($new->channel->image_channel) }}" style="border-radius: 16%; overflow: hidden;" width="60px" alt="">

                                    </div>
                                    <div class="col-9 col-md-6">
                                        <h6 >{{ $new->channel->name_channel }} <i class="fa-solid fa-circle-check" style="color: #74C0FC;"></i></h6>
                                         <i class="fa-solid fa-shop" style="color: #74C0FC;"></i><span class="mx-2 summary-title" style="color: #74C0FC ">Trusted partner</span>

                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('channels.show',$new->channel_id) }}" class="btn btn-primary mt-3 mt-md-0 ms-2"><i class="fa-solid fa-eye"></i> Visit</a>
                                    </div>
                                    </div>
                                    <div class="row pt-2 px-5 ">
                                        <p class="col-6"> <i class="fa-brands fa-product-hunt" style="color: #74C0FC;"></i> {{ $data_count_news }} Selling news <br>
                                            <i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> {{ $data_count_news_sold }} Sold<br>
                                        </p>
                                        <p class="col-6"> <i class="fa-regular fa-face-smile" style="color: #74C0FC;"></i> Positive feedback<br>
                                            <i class="fa-solid fa-clipboard-check" style="color: #74C0FC;"></i> Deposited  <br>
                                        </p>


                                    </div>


                                </div>
                            </div>
                            @else

                                <div class="product-details-footer">
                                <div class="container summary">

                                <div class="row  px-4">
                                                <div class="col-2">

                                                    @if ($get_user->image_user)
                                                    <a href="{{route('user.show',$get_user->user_id)}}">
                                                    <img src="{{ asset($get_user->image_user) }}" style="border-radius: 16%; overflow: hidden;" width="60px" alt="">

                                                    </a>

                                                    @else
                                                    <a href="{{route('user.show',$get_user->user_id)}}">
                                                    <img src="https://i.pinimg.com/originals/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" style="border-radius: 16%; overflow: hidden;" width="60px" alt="">
                                                    </a>
                                                    @endif
                                    </div>
                                    <div class="col-9 col-md-10">
                                        <h6 >   <a class="text-dark" href="{{route('user.show',$get_user->user_id)}}">{{ $get_user->full_name }} <i class="fa-solid fa-user mx-3" style="color: #74C0FC;"></i></a></h6>
                                        <i class="fa-solid fa-circle-exclamation" style="color: #e90707;"></i><span class="mx-2 " style="color: #e90707 ">Please pay attention when trading products that do not receive the protection of the exchange !</span>

                                    </div>




                                        </div>
                                    </div>
                                </div>

                                @endif
                            <!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
            <div id="comments-container">
    @auth
        <h3>Add a Comment</h3>
        <form action="{{ route('comments.store', $new->sale_new_id) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="content" class="form-control" rows="3" placeholder="Write a comment..." required id="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">log in</a> to add a comment.</p>
    @endauth

    @forelse ($comments as $comment)
        <div class=" comment @if($comment->user_id == $new->user_id) seller @endif">
            <div class="comment-header">
                <strong>{{ $comment->user_id == $new->user_id ? 'Seller' : $comment->user->full_name }}</strong>
                @if($comment->user_id == $new->user_id)
                    <span class="badge badge-warning">Seller</span>
                @endif
            </div>
            <p class="comment-content">{{ $comment->content }}</p>
            
            <!-- Reply Button -->
            @auth
                <button class="btn btn-reply" onclick="toggleReplyForm({{ $comment->comment_id }}, '{{ $comment->user->full_name }}')">   <i class="fas fa-reply"></i> Reply</button>
                
                <!-- Reply Form (hidden by default) -->
                <div id="reply-form-{{ $comment->comment_id }}" class="reply-form" style="display:none;">
                    <form action="{{ route('comments.reply', $comment->comment_id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" class="form-control" rows="2" id="content-{{ $comment->comment_id }}" placeholder="Type your reply here..." required></textarea>
                            <input type="hidden" name="original_commenter" value="{{ $comment->user->full_name }}"/>
                        </div>
                        <button type="submit" class="btn btn-secondary">Reply</button>
                    </form>
                </div>
            @endauth

             
        </div>
        <!-- Show replies -->
        <div class="replies-container">
                @foreach ($comment->replies as $reply)
                    <div class="reply">
                        <strong>{{ $reply->user->full_name }}</strong> {{ $reply->content }}
                        
                        
                    </div>
                    @auth
                            <button class="btn btn-reply" onclick="toggleReplyForm({{ $comment->comment_id }}, '{{ $reply->user->full_name }}')">   <i class="fas fa-reply"></i> Reply</button>
                            
                            <!-- Reply Form for reply (hidden by default) -->
                            <div id="reply-form-{{ $reply->comment_id }}" class="reply-form" style="display:none;">
                                <form action="{{ route('comments.reply', $reply->comment_id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="content" class="form-control" rows="2" id="content-{{ $reply->comment_id }}" placeholder="Type your reply here..." required></textarea>
                                        <input type="hidden" name="original_commenter" value="{{ $reply->user->full_name }}"/>
                                    </div>
                                    <button type="submit" class="btn btn-secondary">Reply</button>
                                </form>
                            </div>
                        @endauth
                @endforeach
            </div>
    @empty
        <p>No comments yet. Be the first to comment!</p>
    @endforelse
</div>





            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Detailed information</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Sale News Information</h3>
                            <p>{!! $new->description !!}</p>


                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <h3>Information</h3>

                            <div class="row"> <div class="col-md-7">
                                @if(isset($data_json))
                                <div class="product-info">
                                    @foreach($data_json as $variant)
                                    <div class="product-info-item">
                                        <span class="product-info-name">
                                            {{ $variant->name }}</span>: <span class="product-info-option">{{ $variant->option }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                     @endif
                                    </div>
                                    <div class="col-md-5">
                                        <ul>
                                            <li>Phone number: {{ $new->phone }}</li>
                                            <li>Seller name: {{ $get_user->full_name }}</li>
                                             @if($get_user->address)
                                             <li>Address: {{ $get_user->address }}</li>
                                              @endif </ul>
                                             </div>
                                            </div>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->


                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->



            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

                {{-- {{dd($get_data_7subcategory)}} --}}
                @foreach ($get_data_7subcategory as $item )


                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-new">Operation</span>
                        <a href="{{ route('salenew.detail',$item->sale_new_id) }}">
                            <img src="{{ asset($item->firstImage->image_name) }}" style="height: 200px;" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">

                            <!-- Thêm data-product-id để lưu id sản phẩm -->
                            <form action="{{ route('addToWishlist') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sale_new_id" value="{{ $item->sale_new_id }}">
                                <button type="submit"
                                    class="add-wishlist rounded-circle add-to-wishlist-btn {{ $item->isFavorited ? 'text-white bg-primary' : 'text-primary' }}"
                                    title="{{ $item->isFavorited ? 'Added to wishlist' : 'Add to wishlist' }}">
                                    <i class="{{ $item->isFavorited ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                </button>
                            </form>


                        </div>


                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        {{-- <div class="product-cat">
                            <a href="#">Women</a>
                        </div><!-- End .product-cat --> --}}
                        <h3 class="product-title"><a href="{{ route('salenew.detail',$item->sale_new_id) }}">{{ $item->title }}</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            ${{ $item->price }}
                        </div><!-- End .product-price -->



                    </div><!-- End .product-body -->
                </div><!-- End .product -->
                @endforeach


            </div><!-- End .owl-carousel -->

        </div><!-- End .container -->
    </div><!-- End .page-content -->
    </div>
</main><!-- End .main -->

@endsection
@section('script-link-css')

<script>

    const postTime = new Date('{{ $new->created_at }}');
    function timeSince(date) {
        const seconds = Math.floor((new Date() - date) / 1000);
        let interval = seconds / 31536000;
        if (interval > 1) {
            return Math.floor(interval) + " year";
        }
        interval = seconds / 2592000;
        if (interval > 1) {
            return Math.floor(interval) + " month";
        }
        interval = seconds / 86400;
        if (interval > 1) {
            return Math.floor(interval) + "  days";
        }
        interval = seconds / 3600;
        if (interval > 1) {
            return Math.floor(interval) + " hour";
        }
        interval = seconds / 60;
        if (interval > 1) {
            return Math.floor(interval) + " minutes";
        }
        return Math.floor(seconds) + " seconds";
    }
    document.getElementById("time-ago").textContent = timeSince(postTime);
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="{{  asset('assets/js/jquery.min.js')}}"></script> --}}
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/ajax_wishlist.js') }}"></script>

<script>
    var userId = "{{ Auth::check() ? Auth::user()->user_id : '' }}";
    // Hiển thị thông báo sau khi load trang nếu có từ session
    @if(session('alert'))
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
</script>
<script>
    $(document).ready(function() {

        $('.product-gallery-item').on('click', function(e) {
            e.preventDefault();
            // Lấy URL của ảnh từ thuộc tính data của ảnh nhỏ
            let newImage = $(this).data('image');
            let newZoomImage = $(this).data('zoom-image');
            // Thay đổi hình ảnh và ảnh phóng to của ảnh chính
            $('#product-zoom').attr('src', newImage).data('zoom-image', newZoomImage);
            // Xóa lớp active khỏi tất cả các ảnh nhỏ và thêm vào ảnh được bấm
            $('.product-gallery-item').removeClass('active');
            $(this).addClass('active');
        });

        @if (isset(auth()->user()->user_id))
    // message
    var recipientId = null;
    var currentChannel = null;
    var recipientName = null;
    var recipientImage = null;
    var login_userId = {{ auth()->user()->user_id }};
    $('#message-id').click(function(){
        recipientId = $(this).attr('data-id');
        recipientName = $(this).attr('data-name');
        recipientImage = $(this).attr('data-img');

        $.ajax({
              url: "{{ route('message.checkconversations') }}",
              method: 'GET',
              data: { recipientId: recipientId },
              success: function(response) {
                  if (response.channelExists) {
                    //   subscribeToChannel(response.channelName);
                      localStorage.setItem('channelName', response.channelName);
                      localStorage.setItem('recipientName', recipientName);
                      localStorage.setItem('recipientImage', recipientImage);
                       window.location.href = '{{ route('message.conversations') }}';

                  } else {
                      createNewChannel(recipientId);

                  }
              },
              error: function(xhr, status, error) { console.error(error); }
          });
    });
    function createNewChannel(recipientId) {

        $.ajax({
            url: '{{ route('message.createconversations') }}',
            method: 'GET',
            data: { recipientId: recipientId },
            success: function (response) {
                if(response.success == true){

                localStorage.setItem('channelName', response.channelName);
                localStorage.setItem('recipientName', recipientName);
                localStorage.setItem('recipientImage', recipientImage);
                window.location.href = '{{ route('message.conversations') }}';
                }
                else{

                console.log(response.error);
                }
            },

        });
        }
    @endif
    // Thay đổi hình ảnh chính khi bấm vào ảnh nhỏ

    });

</script>
<script>
  document.getElementById("content").addEventListener("invalid", function(event) {
    event.target.setCustomValidity("This field is required.");
  });

  document.getElementById("content").addEventListener("input", function(event) {
    event.target.setCustomValidity("");
  });
</script>
<script>
    // Function to toggle the visibility of the reply form
    function toggleReplyForm(commentId, commenterName) {
        // Find the reply form for the current comment or reply
        const replyForm = document.getElementById('reply-form-' + commentId);

        // Check if the form is already visible
        const isFormVisible = replyForm.style.display === 'block';
        
        // Hide all other reply forms
        const allReplyForms = document.querySelectorAll('.reply-form');
        allReplyForms.forEach(form => {
            form.style.display = 'none';
        });

        // If the form was not visible, show it
        if (!isFormVisible) {
            replyForm.style.display = 'block';
        }

        // Insert the commenter's name into the textarea with @ prefix
        const textarea = replyForm.querySelector('textarea');
        const replyText = `@${commenterName}, `;
        textarea.value = replyText;

        // Focus on the textarea for the user to start typing
        textarea.focus();
    }
</script>


@endsection
