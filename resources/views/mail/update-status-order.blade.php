@php use App\Models\Order; @endphp
    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo trạng thái đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background: #007bff;
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-size: 20px;
            font-weight: bold;
        }

        .order-info {
            margin: 20px 0;
            font-size: 16px;
        }

        .status {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            width: 100%;
        }

        .status.pending {
            background: #ffc107;
        }

        .status.approved {
            background: #17a2b8;
        }

        .status.shipping {
            background: #4a63ff;
        }

        .status.completed {
            background: #28a745;
        }

        .status.rejected {
            background: #dc3545;
        }

        .message {
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }

        .reject-reason {
            font-style: italic;
            color: #ff0000;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .product-table th, .product-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .product-table th {
            background: #007bff;
            color: white;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .btn {
            display: block;
            text-align: center;
            background: #28a745;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn:hover {
            background: #218838;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        📢 Cập nhật trạng thái đơn hàng
    </div>

    <div class="order-info">
        <p><strong>Mã đơn hàng:</strong> {{ $data['order']->code }}</p>
        <p><strong>Ngày đặt:</strong> {{ $data['order']->created_at ->format('d/m/Y H:i') }}</p>
        <p><strong>Trạng thái:</strong></p>
        <div class="status {{ strtolower($data['order']->status ) }}">
            {{ ucfirst($data['order']->status ) }}
        </div>
        @switch($data['order']->status )
            @case( Order::STATUS_PENDING)
                <p class="message">
                    Đơn hàng của bạn đã được ghi nhận và đang chờ xác nhận. Chúng tôi sẽ xử lý sớm nhất có thể!
                </p>
                @break
            @case( Order::STATUS_APPROVED)
                <p class="message">
                Đơn hàng của bạn đã được xác nhận. Chúng tôi sẽ sớm giao hàng cho bạn.
                </p>
                @break
            @case( Order::STATUS_SHIPPING)
                <p class="message">
                Đơn hàng của bạn đang trên đường giao đến địa chỉ bạn đã cung cấp. Vui lòng chờ đợi!
                </p>
                @break
            @case( Order::STATUS_COMPLETED)
                <p class="message">
                Đơn hàng của bạn đã được giao thành công. Cảm ơn bạn đã mua sắm tại cửa hàng chúng tôi.
                </p>
                @break
            @case( Order::STATUS_REJECTED)
                <p class="message">
                Đơn hàng của bạn đã bị từ chối. Vui lòng liên hệ CSKH để biết thêm chi tiết.
                với lý do:
                </p>
                <p class="reject-reason">
                {{ $data['order']->reject_reason }}
                </p>
                @break
        @endswitch
    </div>

    <table class="product-table">
        <thead>
        <tr>
            <th>Mã sản phẩm</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $data['orderDetails'] as $item )
            <tr>
                <td>SP-00{{ $item->code }}</td>
                <td>{{ $item->product?->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item['sub_total'], 0, ',', '.') }}đ</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="total">Tổng tiền: {{ number_format($data['order']->total, 0, ',', '.') }}đ</p>
    <div class="footer">
        <p>Cảm ơn bạn đã mua sắm tại cửa hàng chúng tôi! Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ CSKH.</p>
    </div>
</div>

</body>
</html>
