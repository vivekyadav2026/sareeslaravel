<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packing Slip - {{ $order->order_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            color: #333;
            background: #fff;
            margin: 0;
            padding: 40px;
        }
        .slip-box {
            max-width: 800px;
            margin: auto;
            border: 1px solid #eee;
            padding: 30px;
            border-radius: 10px;
        }
        .slip-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .title {
            font-size: 20px;
            font-weight: 600;
            text-align: right;
            letter-spacing: 1px;
        }
        .slip-details {
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
        .address-box {
            background: #f9f9f9;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .address-box h4 {
            margin: 0 0 10px 0;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th {
            background: #333;
            color: white;
            text-align: left;
            padding: 12px;
            font-weight: 500;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        .checkbox-cell {
            width: 40px;
            text-align: center;
        }
        .checkbox-placeholder {
            width: 18px;
            height: 18px;
            border: 2px solid #999;
            border-radius: 3px;
            display: inline-block;
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
            background: #333;
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
            .slip-box {
                border: none;
                padding: 0;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="slip-box">
    <div class="slip-header">
        <div class="logo">RaniSahab</div>
        <div class="title">PACKING SLIP</div>
    </div>

    <div class="slip-details">
        <div class="details-col">
            <strong>Boutique Sender:</strong><br>
            RaniSahab Bridal Couture<br>
            Colaba Causeway, Mumbai, India
        </div>
        <div class="details-col right">
            <strong>Order #:</strong> {{ $order->order_number }}<br>
            <strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}<br>
            <strong>Shipping Method:</strong> {{ strtoupper($order->courier_name ?: 'Standard') }}
        </div>
    </div>

    <div class="address-box">
        <h4>Ship To</h4>
        @if($shippingAddress)
            <strong>{{ $order->customer->first_name ?? 'Client' }} {{ $order->customer->last_name ?? '' }}</strong><br>
            {{ $shippingAddress->address_line_1 }}<br>
            @if($shippingAddress->address_line_2) {{ $shippingAddress->address_line_2 }}<br> @endif
            {{ $shippingAddress->city }}, {{ $shippingAddress->state }} - {{ $shippingAddress->postal_code }}<br>
            {{ $shippingAddress->country }}
        @else
            Guest Checkout
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th class="checkbox-cell">Verify</th>
                <th>Product / Item Description</th>
                <th>SKU</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td class="checkbox-cell"><span class="checkbox-placeholder"></span></td>
                    <td><strong>{{ $item->product_name }}</strong></td>
                    <td style="font-family: monospace;">{{ $item->product_sku }}</td>
                    <td><strong>{{ $item->quantity }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Packer Signature: _______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: _______________
        <button class="btn-print" onclick="window.print()">Print Packing Slip</button>
    </div>
</div>

</body>
</html>
