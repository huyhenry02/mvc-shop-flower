<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo đơn hàng mới</title>
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
        .order-info p {
            margin: 5px 0;
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
        📦 Đơn hàng mới từ khách hàng!
    </div>
    <div class="order-info">
        <p><strong>Mã đơn hàng:</strong> {{ $data['order']->code }}</p>
        <p><strong>Khách hàng:</strong> {{ $data['order']->shipping_name }}</p>
        <p><strong>Số điện thoại:</strong> {{ $data['order']->shipping_phone }}</p>
        <p><strong>Địa chỉ giao hàng:</strong> {{ $data['order']->shipping_address }}</p>
    </div>

    <table class="product-table">
        <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $data['orderDetails'] as $item )
            <tr>
                <td>{{ $item->product?->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item['sub_total'], 0, ',', '.') }}đ</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="total">Tổng tiền: {{ number_format($data['order']->total, 0, ',', '.') }}đ</p>

    <a href="http://127.0.0.1:8000/" class="btn">🔎 Xem chi tiết đơn hàng</a>

    <div class="footer">
        <p>Hệ thống quản lý đơn hàng - Vui lòng không trả lời email này.</p>
    </div>
</div>

</body>
</html>
