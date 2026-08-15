<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - RANISAHAB</title>
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
                                        <div style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #c5a880; background-color: #faf8f5; display: inline-block; line-height: 50px; text-align: center; color: #c5a880; font-size: 20px;">👑</div>
                                        <h2 style="color: #8a1224; font-size: 24px; font-weight: normal; text-transform: uppercase; margin: 15px 0 10px; letter-spacing: 1px;">Order Confirmed</h2>
                                        <p style="color: #555555; font-size: 14px; line-height: 1.6; margin: 0; max-width: 480px;">
                                            Thank you for choosing RANISAHAB. Your royal order has been recorded and is currently being processed by our design curators.
                                        </p>
                                    </td>
                                </tr>
                                
                                <!-- Order Metadata -->
                                <tr>
                                    <td style="padding: 15px 0; border-top: 1px solid #eae6df; border-bottom: 1px solid #eae6df;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 13px; color: #666666;">
                                            <tr>
                                                <td>Order Number: <strong style="color: #111111;">{{ $order->order_number }}</strong></td>
                                                <td align="right">Date: <strong style="color: #111111;">{{ $order->created_at->format('d M Y, h:i A') }}</strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Items Purchased Table -->
                                <tr>
                                    <td style="padding-top: 30px;">
                                        <h3 style="color: #8a1224; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 15px; border-bottom: 1px solid #c5a880; padding-bottom: 5px;">Items Purchased</h3>
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
                                                            @if($item->product_sku)
                                                                <br><span style="font-size: 11px; color: #888888; font-weight: normal;">SKU: {{ $item->product_sku }}</span>
                                                            @endif
                                                        </td>
                                                        <td align="center" style="padding: 12px 10px; color: #555555; font-size: 13px;">{{ $item->quantity }}</td>
                                                        <td align="right" style="padding: 12px 10px; color: #111111; font-weight: bold; font-size: 13px;">₹{{ number_format($item->price, 0) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Calculations / Pricing Summary -->
                                <tr>
                                    <td style="padding-top: 20px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 14px; color: #555555;">
                                            <tr>
                                                <td style="padding: 6px 0;">Subtotal</td>
                                                <td align="right" style="color: #111111;">₹{{ number_format($order->subtotal, 0) }}</td>
                                            </tr>
                                            @if($order->discount > 0)
                                                <tr style="color: #28a745;">
                                                    <td style="padding: 6px 0;">Coupon Discount</td>
                                                    <td align="right">-₹{{ number_format($order->discount, 0) }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td style="padding: 6px 0;">GST / Taxes</td>
                                                <td align="right" style="color: #111111;">₹{{ number_format($order->tax, 0) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px 0;">Shipping Charges</td>
                                                <td align="right" style="color: #111111;">
                                                    @if($order->shipping_charge > 0)
                                                        ₹{{ number_format($order->shipping_charge, 0) }}
                                                    @else
                                                        FREE
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr style="font-size: 16px; font-weight: bold; color: #8a1224;">
                                                <td style="padding: 12px 0; border-top: 1px double #c5a880; border-bottom: 1px double #c5a880;">Grand Total</td>
                                                <td align="right" style="padding: 12px 0; border-top: 1px double #c5a880; border-bottom: 1px double #c5a880;">₹{{ number_format($order->total, 0) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Shipping Details Box -->
                                @if($order->shippingAddress)
                                    <tr>
                                        <td style="padding-top: 30px;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #faf8f5; border: 1px solid #eae6df; border-radius: 4px; padding: 20px; font-size: 14px; line-height: 1.6; color: #444444;">
                                                <tr>
                                                    <td>
                                                        <h4 style="color: #8a1224; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 10px;">Delivery Address</h4>
                                                        <strong style="color: #111111;">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</strong><br>
                                                        {{ $order->shippingAddress->address_line_1 }}<br>
                                                        {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} - {{ $order->shippingAddress->postal_code }}<br>
                                                        Phone: {{ $order->customer->phone }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                                
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #0b0907; padding: 30px 20px; border-top: 2px solid #c5a880; color: #a0a0a0; font-size: 12px; line-height: 1.5;">
                            <p style="margin: 0 0 10px 0;">If you have any questions, please contact our Royal Concierge at <a href="mailto:support@ranisahab.com" style="color: #c5a880; text-decoration: none; font-weight: bold;">support@ranisahab.com</a>.</p>
                            <p style="margin: 0;">&copy; 2026 RANISAHAB. All Rights Reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
