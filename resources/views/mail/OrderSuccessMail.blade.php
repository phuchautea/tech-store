<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông tin đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #4CAF50;
            color: white;
        }

        h1, h2, h3 {
            margin-top: 0;
        }

        .total {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Cảm ơn bạn đã đặt hàng tại TechStore!</h1>
    <p>Xin chào, {{ $orderName }},</p>
    <p>Thông tin đơn hàng #{{ $orderCode }} đã được xác nhận.</p>
    <p>Bạn có thể tra cứu chi tiết thông tin đơn hàng <a href="https://{{ $_SERVER['HTTP_HOST'] }}/order/search/{{ $orderCode }}" target="_blank">tại đây</a></p>
    <h1>Thông tin đơn hàng</h1>
    <table>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
        </tr>
        @php $totalPrice = 0; @endphp
        @foreach($orderDetails as $orderDetail)
            @php $totalPrice += $orderDetail->price * $orderDetail->quantity @endphp
            <tr>
                <td>{{ $orderDetail->product_name }} - {{ $orderDetail->product_variant_name }}</td>
                <td>{{ $orderDetail->quantity }}</td>
                <td>{{ number_format($orderDetail->price) }}đ</td>
            </tr>
        @endforeach
    </table>
    <div class="total">
        <h3>Tổng cộng: {{ number_format($totalPrice) }}đ</h3>
    </div>
    <p>Nếu có bất kỳ câu hỏi nào, xin liên hệ với chúng tôi tại <a href="mailto:contact@techstore.com">contact@techstore.com</a></p>
    <div class="total">
        <h3>Trân trọng</h3>
        <h3>TechStore</h3>
    </div>
</div>
</body>
</html>

