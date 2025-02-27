@extends('shop.layouts.main')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Lỗi 404</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('customer.showIndex') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">404</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- 404 Start -->
    <div class="container-fluid py-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                    <h1 class="display-1">404</h1>
                    <h1 class="mb-4">Trang không tìm thấy</h1>
                    <p class="mb-4">Rất tiếc, trang bạn đang tìm kiếm không tồn tại trên trang web của chúng tôi! Có thể bạn hãy vào trang chủ của chúng tôi hoặc thử sử dụng chức năng tìm kiếm?</p>
                    <a class="btn border-secondary rounded-pill py-3 px-5" href="{{ route('customer.showIndex') }}">Quay về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 End -->
@endsection
