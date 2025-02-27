@extends('shop.layouts.main')
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Giỏ hàng</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('customer.showIndex') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Giỏ hàng</li>
        </ol>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $cartItems as $cartItem )
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $cartItem->product?->detail_image ?? '' }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{ $cartItem->product?->name ?? '' }}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 cart-price">{{ number_format($cartItem->product->price) ?? 0}} VNĐ</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;" data-cart-id="{{ $cartItem->id }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0 cart-quantity" value="{{ $cartItem->quantity }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 sub-total">{{ number_format($cartItem->sub_total) ?? 0}} VNĐ</p>
                            </td>
                            <td>
                                <button class="btn btn-md rounded-circle bg-light border mt-4"
                                onclick="confirmDelete('{{ route('customer.removeCartItem', $cartItem->id) }}')">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h5 class="display-6 mb-4"><span class="fw-normal">Hóa đơn tạm tính</span></h5>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Tổng giá trị:</h5>
                                <p class="mb-0 total-cart-price">{{ number_format($totalCart) ?? 0}} VNĐ</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Phí ship</h5>
                                <div class="">
                                    <p class="mb-0">Miễn phí</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Tổng tiền hóa đơn</h5>
                            <p class="mb-0 pe-4 total-cart-price">{{ number_format($totalCart) ?? 0}} VNĐ</p>
                        </div>
                        <a class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" href="{{ route('customer.showCheckout') }}">Tiến hành tạo đơn</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function confirmDelete(url) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
                window.location.href = url;
            }
        }
        $(document).ready(function () {
            $('.btn-plus').click(function (e) {
                e.preventDefault();

                const $inputGroup = $(this).closest('.input-group');
                const $input = $inputGroup.find('.cart-quantity');
                const cartId = $inputGroup.data('cart-id');
                const $row = $inputGroup.closest('tr');
                const cartPrice = parseInt($row.find('.cart-price').text().replace(/\D/g, ''))
                let currentValue = parseInt($input.val()) || 0;

                $input.val(currentValue + 1 - 1);
                updateCartQuantity(cartId, currentValue + 1 - 1);
                updateSubTotal($row, currentValue + 1 - 1, cartPrice);
            });

            $('.btn-minus').click(function (e) {
                e.preventDefault();

                const $inputGroup = $(this).closest('.input-group');
                const $input = $inputGroup.find('.cart-quantity');
                const cartId = $inputGroup.data('cart-id');
                const $row = $inputGroup.closest('tr');
                const cartPrice = parseInt($row.find('.cart-price').text().replace(/\D/g, ''))
                let currentValue = parseInt($input.val()) || 0;

                if (currentValue > 1) {
                    $input.val(currentValue - 1 + 1);
                    updateCartQuantity(cartId, currentValue - 1 + 1);
                    updateSubTotal($row, currentValue - 1 + 1, cartPrice);
                }
            });

            function updateSubTotal($row, quantity, price) {
                console.log(quantity, price);
                const subTotal = quantity * price;
                $row.find('.sub-total').text(new Intl.NumberFormat().format(subTotal) + ' VNĐ');
            }


            function updateCartQuantity(cartId, quantity) {
                $.ajax({
                    url: '{{ route('customer.updateQuantity') }}',
                    method: 'POST',
                    data: {
                        cart_id: cartId,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            $('.total-cart-price').text(
                                new Intl.NumberFormat().format(response.totalCart) + ' VNĐ'
                            );
                        } else {
                            alert('Có lỗi xảy ra: ' + response.message);
                        }
                    },
                    error: function (error) {
                        console.error('Lỗi khi cập nhật giỏ hàng:', error);
                        alert('Đã xảy ra lỗi trong quá trình cập nhật.');
                    }
                });
            }
        });
    </script>
@endsection
