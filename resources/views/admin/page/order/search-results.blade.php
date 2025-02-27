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

