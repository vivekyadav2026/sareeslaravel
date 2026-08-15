<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    $packages = \App\Models\BridalPackage::where('is_active', true)->orderBy('id', 'asc')->get();
    $initialProducts = \App\Models\Product::where('is_active', true)->with(['images'])->latest()->paginate(8);
    $categories = \App\Models\Category::all()->keyBy('slug');
    return view('home', compact('packages', 'initialProducts', 'categories'));
})->name('home');

Route::get('/api/products', [CatalogController::class, 'apiProducts'])->name('api.products');

// Search Route
Route::get('/search', [CatalogController::class, 'search'])->name('search');

// Catalog Routes (Dynamic)
Route::get('/sarees', [CatalogController::class, 'sarees'])->name('sarees');
Route::get('/suits', [CatalogController::class, 'suits'])->name('suits');
Route::get('/lehengas', [CatalogController::class, 'lehengas'])->name('lehengas');
Route::get('/bridal-collection', [CatalogController::class, 'bridalCollection'])->name('bridal-collection');
Route::get('/bridal-packages', [CatalogController::class, 'bridalPackages'])->name('bridal-packages');
Route::post('/cart/add-package', [CartController::class, 'addPackage'])->name('cart.add-package');
Route::get('/makeup-services', [CatalogController::class, 'makeupServices'])->name('makeup-services');
Route::post('/makeup-services', [CatalogController::class, 'submitMakeupBooking'])->name('makeup-services.submit');

Route::get('/product/{slug}', [CatalogController::class, 'showProduct'])->name('product.show');
Route::post('/product/{id}/question', [CatalogController::class, 'submitQuestion'])->name('product.question.submit');

Route::get('/custom-lehenga', [CatalogController::class, 'customLehenga'])->name('custom-lehenga');
Route::post('/custom-lehenga', [CatalogController::class, 'submitCustomLehenga'])->name('custom-lehenga.submit');

Route::get('/gallery', [CatalogController::class, 'gallery'])->name('gallery');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::post('/contact', [CatalogController::class, 'submitContact'])->name('contact.submit');

// Session-based Shopping Bag (Cart) Routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes (Cart preview allowed for all; order placement requires login)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/giftwrap', [CheckoutController::class, 'updateGiftWrap'])->name('checkout.giftwrap');
Route::post('/checkout/coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.coupon');
Route::post('/checkout/coupon/remove', [CheckoutController::class, 'removeCoupon'])->name('checkout.coupon.remove');
Route::post('/checkout/check-pincode', [CheckoutController::class, 'checkPincode'])->name('checkout.check-pincode');

Route::middleware('auth')->group(function () {
    Route::post('/checkout/place', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::post('/checkout/payment-verify', [CheckoutController::class, 'verifyPayment'])->name('checkout.payment-verify');
});

Route::get('/confirmation', [CheckoutController::class, 'confirmation'])->name('confirmation');
Route::get('/tracking', [CheckoutController::class, 'track'])->name('tracking');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
// Fallback for default auth middleware
Route::get('login', function () {
    return redirect()->route('customer.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Customer Authentication & Panel Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('auth/google', [\App\Http\Controllers\Customer\AuthController::class, 'redirectToGoogle'])->name('customer.google.redirect');
    Route::get('auth/google/callback', [\App\Http\Controllers\Customer\AuthController::class, 'handleGoogleCallback'])->name('customer.google.callback');
});

Route::prefix('customer')->name('customer.')->group(function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [\App\Http\Controllers\Customer\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [\App\Http\Controllers\Customer\AuthController::class, 'login'])->name('login.submit');
        Route::get('register', [\App\Http\Controllers\Customer\AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('register', [\App\Http\Controllers\Customer\AuthController::class, 'register'])->name('register.submit');
        Route::get('forgot-password', [\App\Http\Controllers\Customer\AuthController::class, 'showForgotPasswordForm'])->name('password.request');
        Route::post('forgot-password', [\App\Http\Controllers\Customer\AuthController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('reset-password', [\App\Http\Controllers\Customer\AuthController::class, 'showResetPasswordForm'])->name('password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Customer\AuthController::class, 'resetPassword'])->name('password.update');
    });

    // Authenticated customer routes
    Route::middleware('auth')->group(function () {
        Route::post('logout', [\App\Http\Controllers\Customer\AuthController::class, 'logout'])->name('logout');
        
        Route::get('dashboard', [\App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('profile', [\App\Http\Controllers\Customer\DashboardController::class, 'profile'])->name('profile');
        Route::post('profile/update', [\App\Http\Controllers\Customer\DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::post('profile/password', [\App\Http\Controllers\Customer\DashboardController::class, 'updatePassword'])->name('profile.password');
        
        Route::get('addresses', [\App\Http\Controllers\Customer\DashboardController::class, 'addresses'])->name('addresses');
        Route::post('addresses', [\App\Http\Controllers\Customer\DashboardController::class, 'storeAddress'])->name('addresses.store');
        Route::put('addresses/{address}', [\App\Http\Controllers\Customer\DashboardController::class, 'updateAddress'])->name('addresses.update');
        Route::delete('addresses/{address}', [\App\Http\Controllers\Customer\DashboardController::class, 'destroyAddress'])->name('addresses.destroy');
        Route::post('addresses/{address}/default', [\App\Http\Controllers\Customer\DashboardController::class, 'setDefaultAddress'])->name('addresses.default');
        
        Route::get('orders', [\App\Http\Controllers\Customer\DashboardController::class, 'orders'])->name('orders');
        Route::get('orders/{order}', [\App\Http\Controllers\Customer\DashboardController::class, 'showOrder'])->name('orders.show');
        
        Route::get('appointments', [\App\Http\Controllers\Customer\DashboardController::class, 'appointments'])->name('appointments');
        Route::post('appointments', [\App\Http\Controllers\Customer\DashboardController::class, 'storeAppointment'])->name('appointments.store');
        
        Route::get('makeup-bookings', [\App\Http\Controllers\Customer\DashboardController::class, 'makeupBookings'])->name('makeup-bookings');
        Route::post('makeup-bookings', [\App\Http\Controllers\Customer\DashboardController::class, 'storeMakeupBooking'])->name('makeup-bookings.store');
        
        Route::get('custom-designs', [\App\Http\Controllers\Customer\DashboardController::class, 'customDesigns'])->name('custom-designs');
        Route::post('custom-designs', [\App\Http\Controllers\Customer\DashboardController::class, 'storeCustomDesign'])->name('custom-designs.store');
        
        Route::get('measurements', [\App\Http\Controllers\Customer\DashboardController::class, 'measurements'])->name('measurements');
        Route::post('measurements', [\App\Http\Controllers\Customer\DashboardController::class, 'updateMeasurements'])->name('measurements.update');

    });

    // Guest-accessible wishlist routes
    Route::get('wishlist', [\App\Http\Controllers\Customer\DashboardController::class, 'wishlist'])->name('wishlist');
    Route::post('wishlist/toggle', [\App\Http\Controllers\Customer\DashboardController::class, 'toggleWishlist'])->name('wishlist.toggle');
    Route::delete('wishlist/{id}', [\App\Http\Controllers\Customer\DashboardController::class, 'removeWishlist'])->name('wishlist.remove');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated Admin Routes
    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Admin Users
        Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class);

        // Customer Management
        Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);
        Route::post('customers/{customer}/toggle-status', [\App\Http\Controllers\Admin\CustomerController::class, 'toggleStatus'])->name('customers.toggle-status');
        Route::post('customers/{customer}/update-notes', [\App\Http\Controllers\Admin\CustomerController::class, 'updateNotes'])->name('customers.update-notes');
        Route::post('customers/{customer}/adjust-wallet', [\App\Http\Controllers\Admin\CustomerController::class, 'adjustWallet'])->name('customers.adjust-wallet');
        Route::post('customers/{customer}/adjust-points', [\App\Http\Controllers\Admin\CustomerController::class, 'adjustPoints'])->name('customers.adjust-points');

        // Product Categories CRUD
        Route::get('categories', [\App\Http\Controllers\Admin\ProductController::class, 'categoriesIndex'])->name('categories.index');
        Route::post('categories', [\App\Http\Controllers\Admin\ProductController::class, 'categoriesStore'])->name('categories.store');
        Route::put('categories/{category}', [\App\Http\Controllers\Admin\ProductController::class, 'categoriesUpdate'])->name('categories.update');
        Route::delete('categories/{category}', [\App\Http\Controllers\Admin\ProductController::class, 'categoriesDestroy'])->name('categories.destroy');

        // Product Questions CRUD
        Route::post('questions/{question}/answer', [\App\Http\Controllers\Admin\ProductController::class, 'answerQuestion'])->name('questions.answer');
        Route::post('questions/{question}/approve', [\App\Http\Controllers\Admin\ProductController::class, 'approveQuestion'])->name('questions.approve');
        Route::delete('questions/{question}', [\App\Http\Controllers\Admin\ProductController::class, 'destroyQuestion'])->name('questions.destroy');

        // Products Resource CRUD
        Route::delete('product-images/{image}', [\App\Http\Controllers\Admin\ProductController::class, 'destroyImage'])->name('product-images.destroy');
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        // Orders Management
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::get('orders/{order}/invoice', [\App\Http\Controllers\Admin\OrderController::class, 'invoice'])->name('orders.invoice');
        Route::get('orders/{order}/packing-slip', [\App\Http\Controllers\Admin\OrderController::class, 'packingSlip'])->name('orders.packing-slip');
        Route::get('orders/{order}/shipping-label', [\App\Http\Controllers\Admin\OrderController::class, 'shippingLabel'])->name('orders.shipping-label');
        Route::post('orders/{order}/add-note', [\App\Http\Controllers\Admin\OrderController::class, 'addNote'])->name('orders.add-note');
        Route::post('orders/{order}/dispatch-shiprocket', [\App\Http\Controllers\Admin\OrderController::class, 'dispatchShiprocket'])->name('orders.dispatch-shiprocket');

        // Coupons Management
        Route::resource('coupons', \App\Http\Controllers\Admin\CouponController::class);

        // Bridal Appointments & Packages
        Route::get('appointments', [\App\Http\Controllers\Admin\BridalController::class, 'appointmentsIndex'])->name('appointments.index');
        Route::post('appointments/{appointment}/confirm', [\App\Http\Controllers\Admin\BridalController::class, 'confirmAppointment'])->name('appointments.confirm');
        Route::post('appointments/{appointment}/reschedule', [\App\Http\Controllers\Admin\BridalController::class, 'rescheduleAppointment'])->name('appointments.reschedule');
        Route::get('bridal-packages', [\App\Http\Controllers\Admin\BridalController::class, 'packagesIndex'])->name('bridal-packages.index');
        Route::post('bridal-packages', [\App\Http\Controllers\Admin\BridalController::class, 'packagesStore'])->name('bridal-packages.store');
        Route::put('bridal-packages/{package}', [\App\Http\Controllers\Admin\BridalController::class, 'packagesUpdate'])->name('bridal-packages.update');
        Route::delete('bridal-packages/{package}', [\App\Http\Controllers\Admin\BridalController::class, 'packagesDestroy'])->name('bridal-packages.destroy');

        // Custom Bridal Design Requests
        Route::get('design-requests', [\App\Http\Controllers\Admin\BridalController::class, 'designsIndex'])->name('designs.index');
        Route::post('design-requests/{design}/quote', [\App\Http\Controllers\Admin\BridalController::class, 'sendQuotation'])->name('designs.quote');

        // Makeup Booking & Services
        Route::get('makeup-bookings', [\App\Http\Controllers\Admin\MakeupController::class, 'bookingsIndex'])->name('makeup-bookings.index');
        Route::post('makeup-bookings/{booking}/confirm', [\App\Http\Controllers\Admin\MakeupController::class, 'confirmBooking'])->name('makeup-bookings.confirm');
        Route::get('makeup-services', [\App\Http\Controllers\Admin\MakeupController::class, 'servicesIndex'])->name('makeup-services.index');
        Route::post('makeup-services', [\App\Http\Controllers\Admin\MakeupController::class, 'servicesStore'])->name('makeup-services.store');
        Route::delete('makeup-services/{service}', [\App\Http\Controllers\Admin\MakeupController::class, 'servicesDestroy'])->name('makeup-services.destroy');

        // Fitting Measurement Sheets Resource
        Route::resource('measurements', \App\Http\Controllers\Admin\MeasurementController::class);

        // Real Brides Gallery Module
        Route::get('gallery', [\App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('gallery.index');
        Route::post('gallery', [\App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('gallery.store');
        Route::post('gallery/{gallery}/toggle', [\App\Http\Controllers\Admin\GalleryController::class, 'toggleStatus'])->name('gallery.toggle-status');
        Route::delete('gallery/{gallery}', [\App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('gallery.destroy');

        // Contact Inquiries & Concierge Messages
        Route::get('contact-inquiries', [\App\Http\Controllers\Admin\ContactInquiryController::class, 'index'])->name('contact-inquiries.index');
        Route::post('contact-inquiries/{inquiry}/status', [\App\Http\Controllers\Admin\ContactInquiryController::class, 'updateStatus'])->name('contact-inquiries.update-status');
        Route::delete('contact-inquiries/{inquiry}', [\App\Http\Controllers\Admin\ContactInquiryController::class, 'destroy'])->name('contact-inquiries.destroy');

        // Store Configuration Settings
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
