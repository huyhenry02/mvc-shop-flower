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
        @switch( $order->status )
            @case(Order::STATUS_PENDING)
                <button data-order-id="{{ $order->id }}" value="approved" class="btn btn-primary update-order me-2">✅ Xác nhận đơn hàng</button>
                <button data-order-id="{{ $order->id }}" class="btn btn-danger reject-order me-2">❌ Hủy đơn hàng</button>
                @break
            @case(Order::STATUS_APPROVED)
                <button data-order-id="{{ $order->id }}" value="shipping" class="btn btn-secondary update-order me-2">✅ Đơn hàng đã được giao</button>
                <button data-order-id="{{ $order->id }}" class="btn btn-danger reject-order me-2">❌ Hủy đơn hàng</button>
            @case(Order::STATUS_SHIPPING)
                <button data-order-id="{{ $order->id }}" value="completed" class="btn btn-success update-order me-2">✅ Giao hàng thành công</button>
                <button data-order-id="{{ $order->id }}" class="btn btn-danger reject-order me-2">❌ Hủy đơn hàng</button>
                @break
        @endswitch
    </div>

    <div id="rejectOrderModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lý do hủy đơn hàng</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea id="rejectReason" class="form-control" placeholder="Nhập lý do hủy đơn hàng..." rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" id="confirmReject">Xác nhận hủy</button>
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let orderIdToReject = null;

        const rejectButtons = document.querySelectorAll('.reject-order');
        if (rejectButtons.length > 0) {
            rejectButtons.forEach(button => {
                button.addEventListener('click', function () {
                    orderIdToReject = this.getAttribute('data-order-id');
                    const modal = document.getElementById('rejectOrderModal');
                    if (modal) {
                        new bootstrap.Modal(modal).show();
                    } else {
                        console.error("Không tìm thấy modal #rejectOrderModal");
                    }
                });
            });
        } else {
            console.warn("Không tìm thấy bất kỳ nút .reject-order nào trên trang.");
        }

        const confirmRejectBtn = document.getElementById('confirmReject');
        if (confirmRejectBtn) {
            confirmRejectBtn.addEventListener('click', function () {
                const reasonInput = document.getElementById('rejectReason');
                if (!reasonInput) {
                    console.error("Không tìm thấy input lý do hủy đơn hàng.");
                    return;
                }

                const reason = reasonInput.value.trim();
                if (!reason) {
                    alert("Vui lòng nhập lý do hủy!");
                    return;
                }

                if (!orderIdToReject) {
                    console.error("Không tìm thấy ID đơn hàng để hủy.");
                    return;
                }

                fetch(`/admin/order/update-status/${orderIdToReject}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: 'rejected',
                        reject_reason: reason
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.success) location.reload();
                    })
                    .catch(error => console.error('Lỗi:', error));
            });
        } else {
            console.warn("Không tìm thấy nút xác nhận hủy (#confirmReject).");
        }

        // Cập nhật trạng thái đơn hàng khác
        const updateButtons = document.querySelectorAll('.update-order');
        if (updateButtons.length > 0) {
            updateButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = this.getAttribute('data-order-id');
                    const status = this.value;

                    if (!orderId) {
                        console.error("Không tìm thấy ID đơn hàng để cập nhật.");
                        return;
                    }

                    fetch(`/admin/order/update-status/${orderId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ status })
                    })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message);
                            if (data.success) location.reload();
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        } else {
            console.warn("Không tìm thấy bất kỳ nút .update-order nào trên trang.");
        }
    });

</script>
@endsection
