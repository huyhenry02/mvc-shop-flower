@extends('shop.layouts.main')
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Tạo đơn hàng</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('customer.showIndex') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Tạo đơn hàng</li>
        </ol>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Thông tin chi tiết</h1>
            <form action="{{ route('customer.postCheckout') }}" method="post">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <div class="form-item">
                            <label class="form-label my-3">Họ và tên<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" placeholder="Họ và tên người nhận" name="shipping_name">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Địa chỉ<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" placeholder="Địa chỉ nhận hàng chi tiết" name="shipping_address">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Số điện thoại<span class="text-danger"> *</span></label>
                            <input type="tel" class="form-control" placeholder="Số điện thoại người nhận" name="shipping_phone">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Địa chỉ email</label>
                            <input type="email" class="form-control" name="shipping_email">
                        </div>
                        <hr>
                        <div class="form-item">
                            <textarea name="note" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Yêu cầu đặc biệt"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $cartItems as $cartItem )
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="{{ $cartItem->product?->feature_image ?? '' }}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                            </div>
                                        </th>
                                        <td class="py-5">{{ $cartItem->product?->name ?? '' }}</td>
                                        <td class="py-5">{{ number_format($cartItem->product->price) ?? 0}} VNĐ</td>
                                        <td class="py-5">{{ $cartItem->quantity }}</td>
                                        <td class="py-5">{{ number_format($cartItem->sub_total) ?? 0}} VNĐ</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">Tổng tiền</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">{{ number_format($totalCart) ?? 0}} VNĐ</p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Tạo đơn hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
