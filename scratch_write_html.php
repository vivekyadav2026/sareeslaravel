<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();
$request = Illuminate\Http\Request::create('/checkout', 'GET');
$app->instance('request', $request);

use App\Models\User;
Auth::login(User::first() ?: new User());

$html = view('checkout', [
    'cart' => [],
    'subtotal' => 0,
    'discount' => 0,
    'tax' => 0,
    'shipping' => 0,
    'total' => 0,
    'customer' => Auth::user(),
    'defaultAddress' => null,
    'giftWrapCharge' => 0
])->render();

file_put_contents('rendered.html', $html);
echo "HTML written to rendered.html successfully!\n";
