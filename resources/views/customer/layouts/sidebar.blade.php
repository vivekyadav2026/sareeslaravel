<div class="customer-sidebar">
    <div class="customer-sidebar-header">
        @if ($customer)
            {{-- Avatar with first letter --}}
            <div class="sidebar-avatar">
                {{ strtoupper(substr($customer->first_name, 0, 1)) }}
            </div>
            <h5>{{ $customer->first_name }} {{ $customer->last_name }}</h5>

            @if($customer->customerGroup)
                <div class="mt-2">
                    <span class="badge" style="background:rgba(90,11,22,0.55); color:var(--gold-light); border:1px solid rgba(201,162,75,0.35); font-size:0.58rem; letter-spacing:0.08em; padding:0.3rem 0.65rem;">
                        <i class="fa-solid fa-crown me-1"></i>
                        {{ $customer->customerGroup->name }} &bull; {{ number_format($customer->customerGroup->discount_percent, 0) }}% OFF
                    </span>
                </div>
            @else
                <span>Valued Customer</span>
            @endif

        @else
            <div class="sidebar-avatar" style="background:rgba(255,255,255,0.05); border-color:rgba(201,162,75,0.3);">
                <i class="fa-solid fa-user" style="font-size:1rem; color:rgba(201,162,75,0.5);"></i>
            </div>
            <h5>Guest Visitor</h5>
            <span>Boutique Explorer</span>
            <div class="mt-3">
                <a href="{{ route('customer.login') }}" class="btn btn-sm w-100 py-2" style="background:var(--gold); color:var(--bg-black); font-family:var(--font-label); font-size:0.62rem; letter-spacing:0.1em; font-weight:700; border-radius:var(--radius);">
                    SIGN IN / JOIN
                </a>
            </div>
        @endif
    </div>

    <ul class="customer-nav-list">
        @if ($customer)
            <li class="customer-nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                <a href="{{ route('customer.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            </li>
            <li class="customer-nav-item {{ request()->routeIs('customer.orders') || request()->routeIs('customer.orders.show') ? 'active' : '' }}">
                <a href="{{ route('customer.orders') }}"><i class="fa-solid fa-bag-shopping"></i> My Orders</a>
            </li>
        @endif

        <li class="customer-nav-item {{ request()->routeIs('customer.wishlist') ? 'active' : '' }}">
            <a href="{{ route('customer.wishlist') }}"><i class="fa-solid fa-heart"></i> Wishlist</a>
        </li>

        @if ($customer)
            <li class="customer-nav-item {{ request()->routeIs('customer.appointments') ? 'active' : '' }}">
                <a href="{{ route('customer.appointments') }}"><i class="fa-solid fa-calendar-check"></i> Consultations</a>
            </li>
            <li class="customer-nav-item {{ request()->routeIs('customer.makeup-bookings') ? 'active' : '' }}">
                <a href="{{ route('customer.makeup-bookings') }}"><i class="fa-solid fa-spa"></i> Makeup Bookings</a>
            </li>
            <li class="customer-nav-item {{ request()->routeIs('customer.custom-designs') ? 'active' : '' }}">
                <a href="{{ route('customer.custom-designs') }}"><i class="fa-solid fa-scissors"></i> Custom Designs</a>
            </li>
            <li class="customer-nav-item {{ request()->routeIs('customer.measurements') ? 'active' : '' }}">
                <a href="{{ route('customer.measurements') }}"><i class="fa-solid fa-ruler"></i> Fitting Specs</a>
            </li>
            <li class="customer-nav-item {{ request()->routeIs('customer.addresses') ? 'active' : '' }}">
                <a href="{{ route('customer.addresses') }}"><i class="fa-solid fa-map-location-dot"></i> Address Book</a>
            </li>
            <li class="customer-nav-item {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
                <a href="{{ route('customer.profile') }}"><i class="fa-solid fa-user-gear"></i> Profile Settings</a>
            </li>
            <li class="customer-nav-item mt-1 pt-1" style="border-top: 1px solid rgba(201,162,75,0.1);">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-customer').submit();" class="text-danger">
                    <i class="fa-solid fa-right-from-bracket text-danger"></i> Logout
                </a>
                <form id="logout-form-customer" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endif
    </ul>
</div>
