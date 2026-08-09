<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->order_number }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            color: #333;
            background: #fff;
            margin: 0;
            padding: 40px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
            border-radius: 10px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #c5a880;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #c5a880;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .title {
            font-size: 20px;
            font-weight: 600;
            text-align: right;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .details-col {
            flex: 1;
        }
        .details-col.right {
            text-align: right;
        }
        .addresses {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            gap: 20px;
        }
        .address-box {
            flex: 1;
            background: #fdfcf9;
            border: 1px solid #f3ece0;
            padding: 20px;
            border-radius: 8px;
        }
        .address-box h4 {
            margin: 0 0 10px 0;
            color: #c5a880;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background: #c5a880;
            color: white;
            text-align: left;
            padding: 12px;
            font-weight: 500;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        .totals {
            margin-left: auto;
            width: 300px;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }
        .totals-row.grand {
            font-size: 18px;
            font-weight: 700;
            color: #c5a880;
            border-top: 2px solid #c5a880;
            padding-top: 12px;
            margin-top: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 20px;
            color: #999;
            font-size: 13px;
        }
        .btn-print {
            display: block;
            width: 150px;
            margin: 20px auto 0 auto;
            padding: 10px;
            background: #c5a880;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 20px;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        @media print {
            body {
                padding: 0;
            }
            .invoice-box {
                border: none;
                box-shadow: none;
                padding: 0;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="invoice-header">
        <div class="logo">RaniSahab</div>
        <div class="title">INVOICE</div>
    </div>

    <div class="invoice-details">
        <div class="details-col">
            <strong>Boutique Address:</strong><br>
            RaniSahab Bridal Couture<br>
            Colaba Causeway, South Mumbai<br>
            Maharashtra, India
        </div>
        <div class="details-col right">
            <strong>Invoice #:</strong> {{ $order->order_number }}<br>
            <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}<br>
            <strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}
        </div>
    </div>

    <div class="addresses">
        <div class="address-box">
            <h4>Billing Address</h4>
            @if($billingAddress)
                {{ $billingAddress->address_line_1 }}<br>
                @if($billingAddress->address_line_2) {{ $billingAddress->address_line_2 }}<br> @endif
                {{ $billingAddress->city }}, {{ $billingAddress->state }} - {{ $billingAddress->postal_code }}<br>
                {{ $billingAddress->country }}
            @else
                Guest Checkout
            @endif
        </div>
        <div class="address-box">
            <h4>Shipping Address</h4>
            @if($shippingAddress)
                {{ $shippingAddress->address_line_1 }}<br>
                @if($shippingAddress->address_line_2) {{ $shippingAddress->address_line_2 }}<br> @endif
                {{ $shippingAddress->city }}, {{ $shippingAddress->state }} - {{ $shippingAddress->postal_code }}<br>
                {{ $shippingAddress->country }}
            @else
                Guest Checkout
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>SKU</th>
                <th>Quantity</th>
                <th>Price</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td style="font-family: monospace;">{{ $item->product_sku }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td style="text-align: right;">₹{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div class="totals-row">
            <span>Subtotal</span>
            <span>₹{{ number_format($order->subtotal, 2) }}</span>
        </div>
        @if($order->discount > 0)
            <div class="totals-row" style="color: #d9534f;">
                <span>Discount</span>
                <span>-₹{{ number_format($order->discount, 2) }}</span>
            </div>
        @endif
        <div class="totals-row">
            <span>Shipping</span>
            <span>₹{{ number_format($order->shipping_charge, 2) }}</span>
        </div>
        <div class="totals-row">
            <span>Taxes (GST 18%)</span>
            <span>₹{{ number_format($order->tax, 2) }}</span>
        </div>
        <div class="totals-row grand">
            <span>Grand Total</span>
            <span>₹{{ number_format($order->total, 2) }}</span>
        </div>
    </div>

    <div class="footer">
        Thank you for choosing RaniSahab Bridal Couture. For order inquiries or modifications, please contact support@ranisahab.com.
        <button class="btn-print" onclick="window.print()">Print Invoice</button>
    </div>
</div>

</body>
</html>
