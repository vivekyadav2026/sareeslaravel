<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmed - RANISAHAB</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #080706;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #130f0c;
            border: 1px solid #c5a880;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
        }
        .header {
            background-color: #0b0907;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid rgba(197, 168, 128, 0.25);
        }
        .logo {
            color: #c5a880;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .body {
            padding: 40px 30px;
        }
        .title {
            color: #c5a880;
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 10px;
            text-align: center;
            text-transform: uppercase;
            font-weight: 500;
        }
        .subtitle {
            font-size: 14px;
            color: #a0a0a0;
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .order-details {
            margin-bottom: 30px;
            border-collapse: collapse;
            width: 100%;
        }
        .order-details th {
            text-align: left;
            border-bottom: 1px solid rgba(197, 168, 128, 0.25);
            padding: 10px 0;
            color: #c5a880;
            font-size: 14px;
            text-transform: uppercase;
        }
        .order-details td {
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
            color: #ffffff;
        }
        .summary-table {
            width: 100%;
            margin-top: 20px;
            border-top: 1px solid rgba(197, 168, 128, 0.25);
            padding-top: 15px;
        }
        .summary-table td {
            padding: 5px 0;
            font-size: 14px;
            color: #a0a0a0;
        }
        .summary-table .total-row td {
            color: #c5a880;
            font-weight: 700;
            font-size: 18px;
        }
        .address-box {
            background-color: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(197, 168, 128, 0.15);
            border-radius: 6px;
            padding: 20px;
            margin-top: 30px;
            font-size: 14px;
            line-height: 1.6;
        }
        .address-box h4 {
            color: #c5a880;
            margin-top: 0;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-size: 13px;
        }
        .footer {
            background-color: #0b0907;
            padding: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid rgba(197, 168, 128, 0.15);
        }
        .footer a {
            color: #c5a880;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">RANISAHAB</div>
        </div>
        <div class="body">
            <h2 class="title">Order Confirmed 👑</h2>
            <p class="subtitle">Thank you for choosing RANISAHAB. Your royal order has been recorded and is currently being processed by our couture designers.</p>

            <table class="order-details">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right;">₹{{ number_format($item->price, 0) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="summary-table">
                <tr>
                    <td>Subtotal</td>
                    <td style="text-align: right; color: #ffffff;">₹{{ number_format($order->subtotal, 0) }}</td>
                </tr>
                @if($order->discount > 0)
                    <tr style="color: #28a745;">
                        <td>Coupon Discount</td>
                        <td style="text-align: right;">-₹{{ number_format($order->discount, 0) }}</td>
                    </tr>
                @endif
                <tr>
                    <td>GST (Tax)</td>
                    <td style="text-align: right; color: #ffffff;">₹{{ number_format($order->tax, 0) }}</td>
                </tr>
                <tr>
                    <td>Shipping Charges</td>
                    <td style="text-align: right; color: #ffffff;">
                        @if($order->shipping_charge > 0)
                            ₹{{ number_format($order->shipping_charge, 0) }}
                        @else
                            FREE
                        @endif
                    </td>
                </tr>
                <tr class="total-row">
                    <td>Grand Total</td>
                    <td style="text-align: right;">₹{{ number_format($order->total, 0) }}</td>
                </tr>
            </table>

            @if($order->shippingAddress)
                <div class="address-box">
                    <h4>Delivery Address</h4>
                    <strong style="color: #ffffff;">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</strong><br>
                    {{ $order->shippingAddress->address_line_1 }}<br>
                    {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} - {{ $order->shippingAddress->postal_code }}<br>
                    Phone: {{ $order->customer->phone }}
                </div>
            @endif
        </div>
        <div class="footer">
            <p>If you have any questions, please contact our Royal Concierge at <a href="mailto:naveennavarange@gmail.com">naveennavarange@gmail.com</a>.</p>
            <p>&copy; 2026 RANISAHAB. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
