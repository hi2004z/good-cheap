@extends('layouts.client_layout')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="mb-4 text-center text-black fw-bold">
                    <i class="fas fa-bell me-2"></i> Thông báo
                </h2>

                <!-- Display the list of notifications -->
                <ul id="all-list" class="list-unstyled">
                    @forelse ($notifications as $notification)
                        <li class="mb-4">
                            <a href="{{ route('notifications.detail', $notification->notification_id) }}"
                                class="text-decoration-none">
                                <div class="card p-3 border-0 shadow-sm">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title text-black">
                                            {{ Str::limit($notification->title_notification, 100) }}
                                        </h5>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-clock me-2 text-muted text-black"></i>
                                            <span
                                                class="text-muted small">{{ $notification->created_at->format('Y-m-d H:i:s') }}</span>
                                        </div>
                                    </div>
                                    <p class="card-text text-truncate" style="max-width: 100%;">
                                        {!! $notification->content_notification ?? 'No Content' !!}
                                    </p>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="text-center">Không có thông báo nào.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
