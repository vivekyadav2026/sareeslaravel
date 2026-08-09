<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label - {{ $order->order_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 20px;
        }
        .label-box {
            width: 380px;
            height: 580px;
            margin: auto;
            border: 4px solid #000;
            padding: 15px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .carrier-box {
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .weight-box {
            font-size: 14px;
            text-align: right;
        }
        .sender-section {
            font-size: 11px;
            border-bottom: 1px solid #000;
            padding: 8px 0;
            line-height: 1.4;
        }
        .recipient-section {
            font-size: 16px;
            padding: 15px 0;
            line-height: 1.5;
            flex-grow: 1;
        }
        .recipient-section h3 {
            margin: 0 0 5px 0;
            font-size: 18px;
            font-weight: 700;
        }
        .barcode-section {
            border-top: 2px dashed #000;
            padding-top: 15px;
            text-align: center;
        }
        .barcode-mock {
            display: inline-block;
            width: 100%;
            height: 70px;
            background: repeating-linear-gradient(
                90deg,
                #000,
                #000 2px,
                #fff 2px,
                #fff 8px,
                #000 8px,
                #000 12px,
                #fff 12px,
                #fff 14px
            );
            margin-bottom: 5px;
        }
        .tracking-code {
            font-family: monospace;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
        }
        .footer-label {
            border-top: 2px solid #000;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 600;
        }
        .btn-print {
            display: block;
            width: 150px;
            margin: 20px auto 0 auto;
            padding: 10px;
            background: #000;
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
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="label-box">
    <div class="section-header">
        <div class="carrier-box">{{ $order->courier_name ?: 'EXPRESS DELIVERY' }}</div>
        <div class="weight-box">
            <strong>Order Reference:</strong><br>
            {{ $order->order_number }}
        </div>
    </div>

    <div class="sender-section">
        <strong>FROM:</strong><br>
        RaniSahab Boutique Operations<br>
        Colaba Causeway, South Mumbai<br>
        MH - 400001, India
    </div>

    <div class="recipient-section">
        <strong>TO:</strong>
        @if($shippingAddress)
            <h3>{{ $order->customer->first_name ?? 'Client' }} {{ $order->customer->last_name ?? '' }}</h3>
            {{ $shippingAddress->address_line_1 }}<br>
            @if($shippingAddress->address_line_2) {{ $shippingAddress->address_line_2 }}<br> @endif
            {{ $shippingAddress->city }}, {{ $shippingAddress->state }} - <strong>{{ $shippingAddress->postal_code }}</strong><br>
            {{ $shippingAddress->country }}
        @else
            <h3>Guest Checkout</h3>
        @endif
    </div>

    <div class="barcode-section">
        <div class="barcode-mock"></div>
        <div class="tracking-code">TRACKING: {{ $order->tracking_number ?: 'AWB-PENDING-LOGS' }}</div>
    </div>

    <div class="footer-label">
        <span>POSTAGE PAID</span>
        <span>RaniSahab Bridal</span>
    </div>
</div>

<button class="btn-print" onclick="window.print()">Print Shipping Label</button>

</body>
</html>
