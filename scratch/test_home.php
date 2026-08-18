<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();
$request = Illuminate\Http\Request::create('/', 'GET');
$app->instance('request', $request);

try {
    $packages = \App\Models\BridalPackage::where('is_active', true)->orderBy('id', 'asc')->get();
    $initialProducts = \App\Models\Product::where('is_active', true)->with(['images'])->latest()->paginate(8);
    $categories = \App\Models\Category::all()->keyBy('slug');
    $html = view('home', compact('packages', 'initialProducts', 'categories'))->render();
    echo "SUCCESS: Home view rendered successfully!\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "TRACE:\n" . $e->getTraceAsString() . "\n";
}
