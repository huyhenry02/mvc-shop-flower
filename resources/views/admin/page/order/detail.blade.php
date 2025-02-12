@php use App\Models\Order; @endphp
@extends('admin.layouts.main')

@section('content')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div class="w-100">
            <h3 class="fw-bold mb-3">📦 Chi tiết đơn hàng #{{ $order->code }}</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('admin.order.showIndex') }}" class="btn btn-secondary">⬅️ Quay lại</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📝 Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Mã đơn hàng:</strong> {{ $order->code }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->order_date }}</p>
                    <p><strong>Trạng thái:</strong>
                        @switch($order->status)
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
                    </p>
                    <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có ghi chú' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">👤 Thông tin khách hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Tên khách hàng:</strong> {{ $order->shipping_name }}</p>
                    <p><strong>Email:</strong> {{ $order->shipping_email }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->shipping_phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">🛒 Danh sách sản phẩm</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->orderDetails as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->product?->name ?? '' }}</td>
                        <td>{{ $item->quantity ?? '' }}</td>
                        <td>{{ number_format($item->product?->price, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($item->sub_total, 0, ',', '.') }}đ</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-end fw-bold mt-3">
                <h5>Tổng tiền: {{ number_format($order->total, 0, ',', '.') }}đ</h5>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <form action="#" method="POST">
            <button type="submit" name="status" value="completed" class="btn btn-success me-2">✅ Xác nhận hoàn tất
            </button>
            <button type="submit" name="status" value="cancelled" class="btn btn-danger">❌ Hủy đơn hàng</button>
        </form>
    </div>
@endsection
