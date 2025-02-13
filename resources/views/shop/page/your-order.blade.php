@php use App\Models\Order; @endphp
@extends('shop.layouts.main')
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Đơn hàng</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Đơn hàng</li>
        </ol>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Ngày tạo đơn</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order['code'] }}</td>
                            <td>{{ $order['order_date'] }}</td>
                            <td>
                                @switch($order['status'])
                                    @case(Order::STATUS_PENDING)
                                        <span class="badge bg-warning">Chờ xác nhận</span>
                                        @break
                                    @case(Order::STATUS_SHIPPING)
                                        <span class="badge bg-info">Đang giao hàng</span>
                                        @break
                                    @case(Order::STATUS_COMPLETED)
                                        <span class="badge bg-success">Giao hàng thành công</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ number_format($order['total'], 0, ',', '.') }} VNĐ</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#orderDetailModal"
                                        data-order="{{ json_encode($order, JSON_THROW_ON_ERROR) }}">Xem Chi Tiết
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="orderDetailModalLabel">Chi Tiết Đơn Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="orderDetails">
                        <!-- Order details will be dynamically loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const orderDetailModal = document.getElementById('orderDetailModal');
            const orderDetailsContainer = document.getElementById('orderDetails');

            orderDetailModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const order = JSON.parse(button.getAttribute('data-order'));

                let detailsHtml = `
                <div class="mb-3">
                    <p><strong>Mã đơn hàng:</strong> ${order.code}</p>
                    <p><strong>Ngày tạo:</strong> ${order.order_date}</p>
                    <p><strong>Trạng thái:</strong> ${order.status}</p>
                    <p><strong>Tổng tiền:</strong> ${new Intl.NumberFormat('vi-VN').format(order.total)} VNĐ</p>
                </div>
                <h6 class="border-bottom pb-2">Chi tiết sản phẩm</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

                order.items.forEach(item => {
                    detailsHtml += `
                    <tr>
                        <td>${item.product_name}</td>
                        <td>${item.quantity}</td>
                        <td>${new Intl.NumberFormat('vi-VN').format(item.sub_total / item.quantity)} VNĐ</td>
                        <td>${item.sub_total} VNĐ</td>
                    </tr>
                `;
                });

                detailsHtml += `
                        </tbody>
                    </table>
                </div>
            `;
                orderDetailsContainer.innerHTML = detailsHtml;
            });
        });
    </script>
@endsection
