<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order has been Shipped - RANISAHAB</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f7f6f2; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; width: 100% !important;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f7f6f2; padding: 20px 0;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border: 1px solid #c5a880; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #0b0907; padding: 25px 20px; border-bottom: 2px solid #c5a880;">
                            <div style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #c5a880; font-size: 26px; font-weight: bold; letter-spacing: 3px; text-transform: uppercase; margin: 0;">RANISAHAB</div>
                            <div style="color: #ffffff; font-size: 9px; letter-spacing: 4px; text-transform: uppercase; margin-top: 5px; opacity: 0.85;">Luxury Couture</div>
                        </td>
                    </tr>
                    
                    <!-- Content Body -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="padding-bottom: 25px;">
                                        <div style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #c5a880; background-color: #faf8f5; display: inline-block; line-height: 50px; text-align: center; color: #c5a880; font-size: 20px;">🚚</div>
                                        <h2 style="color: #8a1224; font-size: 24px; font-weight: normal; text-transform: uppercase; margin: 15px 0 10px; letter-spacing: 1px;">Order Shipped</h2>
                                        <p style="color: #555555; font-size: 14px; line-height: 1.6; margin: 0; max-width: 480px;">
                                            Exciting news! Your royal order #{{ $order->order_number }} has been handed over to our courier partners and is on its way to you.
                                        </p>
                                    </td>
                                </tr>
                                
                                <!-- Shipment Tracking Box -->
                                <tr>
                                    <td style="padding: 20px; background-color: #faf8f5; border: 1px solid #c5a880; border-radius: 4px; text-align: center;">
                                        <h4 style="color: #8a1224; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 10px;">Tracking Details</h4>
                                        <p style="color: #333333; font-size: 14px; margin: 0 0 15px 0; line-height: 1.5;">
                                            Courier: <strong>{{ $order->courier_name ?: 'Shiprocket Express' }}</strong><br>
                                            AWB / Tracking Number: <strong>{{ $order->tracking_number }}</strong>
                                        </p>
                                        <a href="{{ route('tracking', ['number' => $order->tracking_number]) }}" style="background-color: #8a1224; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 4px; font-size: 13px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; display: inline-block; box-shadow: 0 3px 8px rgba(138, 18, 36, 0.2);">TRACK YOUR ORDER</a>
                                    </td>
                                </tr>

                                <!-- Items List -->
                                <tr>
                                    <td style="padding-top: 30px;">
                                        <h3 style="color: #8a1224; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 15px; border-bottom: 1px solid #c5a880; padding-bottom: 5px;">Items Shipped</h3>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 14px; border-collapse: collapse;">
                                            <thead>
                                                <tr style="background-color: #faf8f5;">
                                                    <th align="left" style="padding: 10px; border-bottom: 2px solid #eae6df; color: #8a1224; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Item Details</th>
                                                    <th align="center" style="padding: 10px; border-bottom: 2px solid #eae6df; color: #8a1224; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; width: 60px;">Qty</th>
                                                    <th align="right" style="padding: 10px; border-bottom: 2px solid #eae6df; color: #8a1224; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; width: 100px;">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->items as $item)
                                                    <tr style="border-bottom: 1px solid #eae6df;">
                                                        <td style="padding: 12px 10px; color: #111111; font-weight: bold; font-size: 13px;">
                                                            {{ $item->product_name }}
                                                        </td>
                                                        <td align="center" style="padding: 12px 10px; color: #555555; font-size: 13px;">{{ $item->quantity }}</td>
                                                        <td align="right" style="padding: 12px 10px; color: #111111; font-weight: bold; font-size: 13px;">₹{{ number_format($item->price, 0) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Grand Total -->
                                <tr>
                                    <td style="padding-top: 15px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 14px; color: #555555;">
                                            <tr style="font-size: 15px; font-weight: bold; color: #8a1224;">
                                                <td style="padding: 12px 0; border-top: 1px double #c5a880; border-bottom: 1px double #c5a880;">Grand Total</td>
                                                <td align="right" style="padding: 12px 0; border-top: 1px double #c5a880; border-bottom: 1px double #c5a880;">₹{{ number_format($order->total, 0) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    @php $storeEmail = \App\Models\Setting::getVal('store_email', 'Ranisahab01@gmail.com'); @endphp
                    <tr>
                        <td align="center" style="background-color: #0b0907; padding: 30px 20px; border-top: 2px solid #c5a880; color: #a0a0a0; font-size: 12px; line-height: 1.5;">
                            <p style="margin: 0 0 10px 0;">If you have any questions, please contact our Royal Concierge at <a href="mailto:{{ $storeEmail }}" style="color: #c5a880; text-decoration: none; font-weight: bold;">{{ $storeEmail }}</a>.</p>
                            <p style="margin: 0;">&copy; {{ date('Y') }} RANISAHAB. All Rights Reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
