@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div class="w-100">
            <h3 class="fw-bold mb-3">Danh sách đơn hàng</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="order-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="5%">STT</th>
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Người đặt</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th class="text-center" scope="col" width="10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->code }}</td>
                            <td>{{ $order->user?->name }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ number_format($order->total, 0, ',', '.') }} VNĐ</td>
                            <td>
                                @switch($order->status)
                                    @case(\App\Models\Order::STATUS_PENDING)
                                    <span class="badge bg-warning">Chờ xác nhận</span>
                                    @break
                                    @case(\App\Models\Order::STATUS_SHIPPING)
                                    <span class="badge bg-info">Đang giao hàng</span>
                                    @break
                                    @case(\App\Models\Order::STATUS_COMPLETED)
                                    <span class="badge bg-success">Giao hàng thành công</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.order.showDetail', $order->id) }}"
                                   class="btn btn-sm btn-secondary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.order.showUpdate', $order->id) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
