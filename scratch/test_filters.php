<?php

// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Create request with query parameters
$request = Illuminate\Http\Request::create('/lehengas', 'GET', [
    'occasions' => ['Bridal']
]);

$response = $kernel->handle($request);
$html = $response->getContent();

// Parse and inspect product names
preg_match_all('/<h5 class="wishlist-card-title">([^<]+)<\/h5>|<p class="plp-card-name">[^<]*<a[^>]+>([^<]+)<\/a>/', $html, $matches);

echo "Products found on page under filter ?occasions[]=Bridal:\n";
foreach (array_filter(array_merge($matches[1], $matches[2])) as $name) {
    echo "- " . trim($name) . "\n";
}
