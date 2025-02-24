@extends('shop.layouts.main')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Liên lạc</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('customer.showIndex') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Liên lạc</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Liên lạc</h1>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <iframe class="rounded w-100" height="500" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4613.841924936289!2d105.76764584859791!3d19.81310498349393!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3136f7f781d7fa87%3A0x9757fd60a903a938!2zUXXhuqNuZyB0csaw4budbmcgTGFtIFPGoW4sIFRoYW5oIEjDs2EsIFZp4buHdCBOYW0!5e1!3m2!1svi!2sus!4v1739158506718!5m2!1svi!2sus" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form action="" class="">
                            <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Tên của bạn">
                            <input type="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Email">
                            <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Lời nhắn"></textarea>
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary " type="submit">Gửi đi</button>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Địa chỉ</h4>
                                <p class="mb-2">Thành phố Thanh Hóa</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Địa chỉ Email</h4>
                                <p class="mb-2">info@example.com</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Số điện thoại</h4>
                                <p class="mb-2">(+012) 3456 7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
