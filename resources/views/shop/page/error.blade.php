@extends('shop.layouts.main')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Lỗi Máy chủ</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('customer.showIndex') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Lỗi Máy chủ</li>
        </ol>
    </div>
    <!-- Header End -->

    <!-- Error Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-server display-1 text-secondary"></i>
                    <h1 class="display-1">500</h1>
                    <h1 class="mb-4">Lỗi Máy Chủ</h1>
                    <p class="mb-4">
                        Rất tiếc! Đã có lỗi xảy ra trên máy chủ của chúng tôi.
                        Vui lòng thử lại sau hoặc liên hệ với bộ phận hỗ trợ để được trợ giúp.
                    </p>
                    <a class="btn border-secondary rounded-pill py-3 px-5" href="{{ route('customer.showIndex') }}">
                        Quay về trang chủ
                    </a>
                    <a class="btn btn-secondary rounded-pill py-3 px-5 ms-3" href="mailto:support@example.com">
                        Liên hệ hỗ trợ
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Error Page End -->
@endsection
