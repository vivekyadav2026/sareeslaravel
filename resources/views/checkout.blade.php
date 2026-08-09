@extends('layouts.app')

@section('title', 'Secure Checkout — RANISAHAB Luxury')

@push('styles')
<style>
  /* Set body background to dark */
  body {
      background-color: #0a0806 !important;
      color: var(--ivory) !important;
  }
  
  /* Steps navigation dark background */
  .checkout-steps-nav {
      background-color: #14110f !important;
      border-bottom: 1px solid rgba(201, 162, 75, 0.25) !important;
  }
  .checkout-step-item {
      color: var(--text-muted) !important;
  }
  .checkout-step-item.active {
      color: var(--gold-light) !important;
  }
  .checkout-step-circle {
      background-color: #24201c !important;
      color: var(--text-muted) !important;
      border: 1px solid rgba(201, 162, 75, 0.2) !important;
  }
  .checkout-step-item.active .checkout-step-circle {
      background-color: var(--gold-dark) !important;
      color: #fff !important;
      box-shadow: 0 0 10px rgba(201, 162, 75, 0.4) !important;
  }
  .checkout-step-item.done .checkout-step-circle {
      background-color: var(--bg-black) !important;
      color: var(--gold) !important;
  }

  /* Checkout card boxes dark theme overrides */
  .checkout-card-box {
      background: rgba(24, 21, 19, 0.85) !important;
      border: 1px solid rgba(201, 162, 75, 0.3) !important;
      color: var(--ivory) !important;
      box-shadow: var(--shadow-lift) !important;
      border-radius: 4px !important;
  }
  .checkout-card-box h5 {
      color: var(--gold-light) !important;
      border-bottom: 1px solid rgba(201, 162, 75, 0.15) !important;
      padding-bottom: 0.8rem !important;
      font-weight: 700 !important;
  }
  
  /* Inputs inside dark checkout cards */
  .form-control-luxury {
      background: rgba(255, 255, 255, 0.03) !important;
      border: 1px solid rgba(201, 162, 75, 0.25) !important;
      color: var(--ivory) !important;
      padding: 0.75rem 1rem !important;
      border-radius: 2px !important;
      transition: all 0.25s ease !important;
  }
  .form-control-luxury:focus {
      background: rgba(255, 255, 255, 0.08) !important;
      border-color: var(--gold) !important;
      box-shadow: 0 0 15px rgba(201, 162, 75, 0.25) !important;
      outline: none !important;
      color: var(--ivory) !important;
  }
  
  /* Select inputs inside form */
  .form-select {
      background-color: rgba(255, 255, 255, 0.03) !important;
      border: 1px solid rgba(201, 162, 75, 0.25) !important;
      color: var(--ivory) !important;
  }
  .form-select option {
      background-color: #110f0e !important;
      color: var(--ivory) !important;
  }

  /* Shiprocket Partner Box and COD fields */
  .payment-method-row {
      border: 1px solid rgba(201, 162, 75, 0.2) !important;
      background: rgba(255, 255, 255, 0.02) !important;
      color: var(--ivory) !important;
  }
  .payment-method-row:hover,
  .payment-method-row.selected {
      border-color: var(--gold) !important;
      background-color: rgba(201, 162, 75, 0.08) !important;
  }
  
  /* Delivery Partner alert wrap */
  .delivery-partner-wrap {
      background: rgba(201, 162, 75, 0.05) !important;
      border: 1px solid rgba(201, 162, 75, 0.2) !important;
  }
  
  /* Typography adjusters */
  .text-maroon {
      color: var(--gold-light) !important;
  }
  .text-dark {
      color: var(--ivory) !important;
  }
  .text-muted {
      color: rgba(255, 255, 255, 0.6) !important;
  }
  .border-bottom {
      border-bottom-color: rgba(201, 162, 75, 0.15) !important;
  }
  h6 {
      color: var(--ivory) !important;
  }
  .payment-method-row .text-muted {
      color: rgba(255, 255, 255, 0.45) !important;
  }
  .form-control-luxury::placeholder {
      color: rgba(255, 255, 255, 0.35) !important;
  }
  
  /* Gift wrapping check */
  .form-check-label {
      color: var(--ivory-dark) !important;
  }
  
  /* Mobile Responsive adjustments */
  @media (max-width: 575.98px) {
      .checkout-step-line {
          display: none !important;
      }
      .checkout-step-item span {
          font-size: 0.65rem !important;
      }
      .checkout-card-box {
          padding: 1.1rem !important;
      }
      /* Order items mobile layout adjustment */
      .checkout-card-box img {
          width: 65px !important;
          height: 85px !important;
      }
      .font-display.fs-4 {
          font-size: 1.2rem !important;
      }
      .font-display.fs-3 {
          font-size: 1.3rem !important;
      }
  }
</style>
@endpush

@section('content')
<!-- Checkout Steps Header -->
<div class="checkout-steps-nav py-3">
  <div class="container d-flex justify-content-center align-items-center gap-2 flex-wrap">
    <div class="checkout-step-item done">
      <div class="checkout-step-circle"><i class="fa-solid fa-check"></i></div>
      <span>CART</span>
    </div>
    <div class="checkout-step-line"></div>
    <div class="checkout-step-item active">
      <div class="checkout-step-circle">2</div>
      <span>ADDRESS &amp; PAYMENT</span>
    </div>
    <div class="checkout-step-line"></div>
    <div class="checkout-step-item">
      <div class="checkout-step-circle">3</div>
      <span>CONFIRMATION</span>
    </div>
  </div>
</div>

<!-- Section Header -->
<div class="container pt-4 pb-2 text-center">
  <span class="motif text-gold">❖</span>
  <h2 class="font-display text-maroon" style="font-size:1.8rem;letter-spacing:0.1em;">SECURE CHECKOUT</h2>
</div>

<!-- Checkout Main Section -->
<div class="container pb-5">
  <div class="row g-4">
    
    <!-- Left Column: Order, Address, Preference, Place Order -->
    <div class="col-lg-7">
      
      <!-- 1. Your Order -->
      <div class="checkout-card-box mb-4">
        <h5>1. YOUR ORDER ({{ collect($cart)->sum('quantity') }} {{ Str::plural('ITEM', collect($cart)->sum('quantity')) }})</h5>
        <div class="d-flex flex-column gap-3">
          @foreach ($cart as $item)
            <div class="d-flex gap-3 align-items-center pb-3 border-bottom border-light-subtle last-no-border" id="cart-item-{{ $item['id'] }}">
              <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width:80px;height:100px;object-fit:cover;border-radius:2px;border:1px solid #e0d5be;">
              <div class="flex-fill">
                <h6 class="mb-1 font-display fs-5">{{ $item['name'] }}</h6>
                <p class="small text-muted mb-1">Color: <strong class="text-dark">{{ $item['color'] }}</strong> &nbsp;|&nbsp; Size: <strong class="text-dark">{{ $item['size'] }}</strong></p>
                <div class="d-flex align-items-center gap-3">
                  <div class="d-flex align-items-center gap-1">
                    <span class="small text-muted">Qty:</span>
                    <select class="form-select form-select-sm w-auto" onchange="updateCartQty({{ $item['id'] }}, this.value)">
                      @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                  </div>
                  <button type="button" class="btn btn-sm text-danger border-0 p-0 fs-7" onclick="removeCartItem({{ $item['id'] }})">
                    <i class="fa-solid fa-trash-can me-1"></i> Remove
                  </button>
                </div>
              </div>
              <div class="text-end">
                <span class="fw-bold text-maroon fs-5">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
              </div>
            </div>
          @endforeach
        </div>
        
        <div class="form-check mt-3 pt-2">
          <input class="form-check-input" type="checkbox" id="giftWrap" {{ $giftWrapCharge > 0 ? 'checked' : '' }} onchange="toggleGiftWrap(this.checked)">
          <label class="form-check-label small" for="giftWrap">
            <i class="fa-solid fa-gift text-gold me-1"></i>Add Gift Packaging &nbsp;<span class="text-muted">Luxury Gift Wrap ₹199</span>
          </label>
        </div>
      </div>

      <div class="checkout-card-box mb-4">
        <h5 class="mb-3">2. DELIVERY ADDRESS</h5>

        {{-- Detect Location Button --}}
        <div class="mb-3 p-3 rounded" style="background: rgba(201,162,75,0.06); border: 1px dashed rgba(201,162,75,0.3);">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
              <p class="mb-0 small fw-bold" style="color:var(--gold-light); font-family:var(--font-label); letter-spacing:0.08em;">
                <i class="fa-solid fa-location-crosshairs me-2 text-gold"></i>AUTO-DETECT MY LOCATION
              </p>
              <p class="mb-0 small" style="color:rgba(251,248,241,0.45); font-size:0.75rem;">
                Instantly fill city, state & pincode using your device GPS
              </p>
            </div>
            <button type="button" id="detectLocationBtn" onclick="detectLocation()"
              class="btn d-flex align-items-center gap-2"
              style="background:var(--gold); color:var(--bg-black); font-family:var(--font-label); font-size:0.65rem; letter-spacing:0.1em; font-weight:700; padding:0.55rem 1.2rem; border-radius:var(--radius); white-space:nowrap;">
              <i class="fa-solid fa-crosshairs"></i> DETECT LOCATION
            </button>
          </div>
          <div id="locationStatus" class="mt-2 small d-none"></div>
        </div>

        <form id="shippingForm" class="row g-3">
          <div class="col-md-6">
            <label class="small text-muted mb-1">Full Name <span class="text-danger">*</span></label>
            <input type="text" id="ship_name" class="form-control form-control-luxury" required value="{{ old('name', $customer ? ($customer->first_name . ' ' . $customer->last_name) : '') }}" placeholder=" नेहा शर्मा">
          </div>
          <div class="col-md-6">
            <label class="small text-muted mb-1">Phone Number <span class="text-danger">*</span></label>
            <input type="text" id="ship_phone" class="form-control form-control-luxury" required value="{{ old('phone', $customer->phone ?? '') }}" placeholder="+91 98765 43210">
          </div>
          <div class="col-12">
            <label class="small text-muted mb-1">Email Address <span class="text-danger">*</span></label>
            <input type="email" id="ship_email" class="form-control form-control-luxury" required value="{{ old('email', $customer->email ?? '') }}" placeholder="name@example.com">
          </div>
          <div class="col-12">
            <label class="small text-muted mb-1">Street Address <span class="text-danger">*</span></label>
            <input type="text" id="ship_address" class="form-control form-control-luxury" required value="{{ old('address', $defaultAddress->address_line_1 ?? '') }}" placeholder="123, Green Avenue, Sector 15">
          </div>
          <div class="col-md-4">
            <label class="small text-muted mb-1">City <span class="text-danger">*</span></label>
            <input type="text" id="ship_city" class="form-control form-control-luxury" required value="{{ old('city', $defaultAddress->city ?? '') }}" placeholder="Jaipur">
          </div>
          <div class="col-md-4">
            <label class="small text-muted mb-1">State <span class="text-danger">*</span></label>
            <input type="text" id="ship_state" class="form-control form-control-luxury" required value="{{ old('state', $defaultAddress->state ?? '') }}" placeholder="Rajasthan">
          </div>
          <div class="col-md-4">
            <label class="small text-muted mb-1">Pincode <span class="text-danger">*</span></label>
            <input type="text" id="ship_pincode" class="form-control form-control-luxury" required value="{{ old('pincode', $defaultAddress->postal_code ?? '') }}" placeholder="302001">
          </div>
        </form>
      </div>

      <!-- 3. Delivery Preference -->
      <div class="checkout-card-box mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h5 class="mb-0">3. DELIVERY PARTNER (SHIPROCKET)</h5>
          <span class="badge bg-success bg-opacity-10 text-success border border-success small"><i class="fa-solid fa-truck-fast me-1"></i>Free Express</span>
        </div>
        <div class="d-flex justify-content-between align-items-center p-3 rounded delivery-partner-wrap">
          <div>
            <p class="small text-muted mb-1">Estimated Delivery Logistics</p>
            <p class="fw-bold mb-0 text-maroon" style="font-size:1.1rem;"><i class="fa-regular fa-calendar-check me-2 text-gold"></i>Expected in 3 – 5 Business Days</p>
          </div>
          <i class="fa-solid fa-truck-fast text-gold display-6"></i>
        </div>
      </div>



    </div>

    <!-- Right Column: Payment Details & Order Summary -->
    <div class="col-lg-5">
      
      <!-- 4. Payment Details -->
      <div class="checkout-card-box mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">4. PAYMENT METHOD</h5>
          <span class="badge bg-success bg-opacity-10 text-success border border-success small"><i class="fa-solid fa-lock me-1"></i>100% Secure</span>
        </div>
        
        <!-- Online UPI Razorpay -->
        <div class="payment-method-row selected" onclick="selectPaymentMethod('upi_razorpay', this)">
          <div class="d-flex align-items-center gap-2">
            <input class="form-check-input mt-0" type="radio" name="payType" checked id="p1">
            <label class="form-check-label fw-bold mb-0" for="p1"><i class="fa-solid fa-qrcode me-2 text-maroon"></i>Prepaid (Razorpay Gateway)</label>
          </div>
          <span class="small text-muted">UPI · Cards · Net Banking</span>
        </div>

        <!-- COD -->
        <div class="payment-method-row" onclick="selectPaymentMethod('cod', this)">
          <div class="d-flex align-items-center gap-2">
            <input class="form-check-input mt-0" type="radio" name="payType" id="p2">
            <label class="form-check-label fw-bold mb-0" for="p2"><i class="fa-solid fa-wallet me-2 text-maroon"></i>Cash on Delivery (COD)</label>
          </div>
          <span class="small text-muted">Pay on Delivery</span>
        </div>

        <!-- Coupon Code -->
        <div class="mt-4 pt-3 border-top">
          <p class="small fw-bold text-uppercase mb-2" style="font-family:var(--font-label);">APPLY COUPON</p>
          <div class="input-group">
            <input type="text" id="couponInput" class="form-control form-control-luxury" value="{{ session('coupon_code', '') }}" placeholder="Enter Coupon Code">
            @if(session('coupon_code'))
              <button class="btn btn-danger" type="button" onclick="removeCoupon()">REMOVE</button>
            @else
              <button class="btn btn-gold" type="button" onclick="applyCoupon()">APPLY</button>
            @endif
          </div>
          <div id="couponMessage" class="small mt-1 d-block">
            @if(session('coupon_code'))
              <span class="text-success"><i class="fa-solid fa-circle-check me-1"></i>Coupon '{{ session('coupon_code') }}' applied successfully!</span>
            @endif
          </div>
        </div>
      </div>

      <!-- Order Summary -->
      <div class="checkout-card-box">
        <h5>ORDER SUMMARY</h5>
        <div class="d-flex justify-content-between py-2 border-bottom border-light-subtle small">
          <span class="text-muted">Subtotal</span>
          <span>₹{{ number_format($subtotal, 0) }}</span>
        </div>
        <div class="d-flex justify-content-between py-2 border-bottom border-light-subtle small">
          <span class="text-muted">Gift Packaging</span>
          <span id="summaryGiftWrap">₹{{ number_format($giftWrapCharge, 0) }}</span>
        </div>
        <div class="d-flex justify-content-between py-2 border-bottom border-light-subtle small">
          <span class="text-muted">Shipping Charges</span>
          @if ($shipping > 0)
            <span>₹{{ number_format($shipping, 0) }}</span>
          @else
            <span class="text-success fw-bold">FREE</span>
          @endif
        </div>
        <div class="d-flex justify-content-between py-2 border-bottom border-light-subtle small">
          <span class="text-muted">GST (18% Included)</span>
          <span>₹{{ number_format($tax, 0) }}</span>
        </div>
        @if ($discount > 0)
          <div class="d-flex justify-content-between py-2 border-bottom border-light-subtle small">
            <span class="text-muted">Discount</span>
            <span class="text-success fw-bold">−₹{{ number_format($discount, 0) }}</span>
          </div>
        @endif
        
        <div class="d-flex justify-content-between align-items-baseline pt-3 mt-1">
          <strong class="font-display fs-4 text-maroon">Total Amount</strong>
          <strong class="font-display fs-3 text-maroon">₹{{ number_format($total, 0) }}</strong>
        </div>
        <p class="small text-muted mb-3">Inclusive of all taxes</p>

        <!-- Trust Badges -->
        <div class="d-flex justify-content-between text-center pt-3 border-top small text-muted mb-4">
          <div><i class="fa-solid fa-shield-halved text-gold d-block mb-1 fs-5"></i>SSL SECURE</div>
          <div><i class="fa-solid fa-rotate-left text-gold d-block mb-1 fs-5"></i>EASY RETURNS</div>
          <div><i class="fa-solid fa-award text-gold d-block mb-1 fs-5"></i>100% AUTHENTIC</div>
        </div>

        <!-- Main Action Button -->
        <div class="mb-2">
          <button type="button" id="placeOrderBtn" onclick="submitSecureOrder()" class="btn btn-gold w-100 py-3 shadow-lg fs-6 d-flex align-items-center justify-content-center gap-2" style="font-size:0.9rem;">
            <i class="fa-solid fa-lock fs-5"></i> PLACE SECURE ORDER
          </button>
          <p class="small text-muted text-center mt-2 mb-0">By placing this order, you agree to our <a href="#" class="text-maroon">Terms &amp; Conditions</a> and <a href="#" class="text-maroon">Privacy Policy</a>.</p>
        </div>
      </div>

    </div>

  </div>

  <!-- Support Section -->
  <div class="row g-4 mt-3">
    <div class="col-md-12">
      <div class="need-help-box rounded text-center">
        <p class="motif text-gold mb-1">❖ NEED HELP? ❖</p>
        <h5 class="font-display text-gold-light mb-3">Our Luxury Support Team Is Here For You</h5>
        <div class="d-flex justify-content-center gap-4 flex-wrap small">
          <a href="#" class="btn btn-whatsapp"><i class="fa-brands fa-whatsapp fs-5"></i> WHATSAPP CHAT (+91 12345 67890)</a>
          <span class="d-flex align-items-center gap-2"><i class="fa-solid fa-phone text-gold fs-5"></i> CALL US: 10 AM – 8 PM</span>
          <span class="d-flex align-items-center gap-2"><i class="fa-solid fa-envelope text-gold fs-5"></i> EMAIL: support@ranisahab.com</span>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
let selectedPayment = 'upi_razorpay';

function selectPaymentMethod(method, element) {
    selectedPayment = method;
    document.querySelectorAll('.payment-method-row').forEach(r => r.classList.remove('selected'));
    element.classList.add('selected');
    const radio = element.querySelector('input[type="radio"]');
    if (radio) radio.checked = true;
}

function updateCartQty(productId, qty) {
    fetch("{{ route('cart.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({ product_id: productId, quantity: qty })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    });
}

function removeCartItem(productId) {
    fetch("{{ route('cart.remove') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    });
}

function toggleGiftWrap(checked) {
    fetch("{{ route('checkout.giftwrap') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({ gift_wrap: checked ? 1 : 0 })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    });
}

function applyCoupon() {
    const code = document.getElementById('couponInput').value;
    if(!code) return;
    
    fetch("{{ route('checkout.coupon') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({ code: code })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showToast(data.message);
            setTimeout(() => window.location.reload(), 1000);
        } else {
            document.getElementById('couponMessage').innerHTML = `<span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-1"></i>${data.message}</span>`;
        }
    });
}

function removeCoupon() {
    fetch("{{ route('checkout.coupon.remove') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    });
}

function submitSecureOrder() {
    const btn = document.getElementById('placeOrderBtn');
    const originalContent = btn.innerHTML;

    const name = document.getElementById('ship_name').value;
    const phone = document.getElementById('ship_phone').value;
    const email = document.getElementById('ship_email').value;
    const address = document.getElementById('ship_address').value;
    const city = document.getElementById('ship_city').value;
    const state = document.getElementById('ship_state').value;
    const pincode = document.getElementById('ship_pincode').value;

    if (!name || !phone || !email || !address || !city || !state || !pincode) {
        showToast("Please fill all required shipping fields.");
        return;
    }

    // Disable button to prevent double-submissions
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin fs-5"></i> PROCESSING ORDER...';

    const payload = {
        name: name,
        phone: phone,
        email: email,
        address: address,
        city: city,
        state: state,
        pincode: pincode,
        payment_method: selectedPayment
    };

    fetch("{{ route('checkout.place') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            showToast(data.message || "Order placement failed.");
            btn.disabled = false;
            btn.innerHTML = originalContent;
            return;
        }

        if (!data.payment_required) {
            // Cash on delivery redirects to confirmation
            window.location.href = data.redirect_url;
            return;
        }

        // Razorpay Payment Gateway options
        const options = {
            key: data.key_id,
            amount: data.amount,
            currency: "INR",
            name: "RANISAHAB Luxury",
            description: "Prepaid couture order transaction",
            order_id: data.razorpay_order_id,
            modal: {
                ondismiss: function () {
                    showToast("Payment cancelled. You can try placing the order again.");
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                }
            },
            handler: function (response) {
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin fs-5"></i> VERIFYING PAYMENT...';
                
                // Verify payment details with backend callback
                fetch("{{ route('checkout.payment-verify') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        order_id: data.order_id,
                        razorpay_payment_id: response.razorpay_payment_id || 'mock_pay_id',
                        razorpay_order_id: response.razorpay_order_id || data.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature || 'mock_signature'
                    })
                })
                .then(res => res.json())
                .then(verifyData => {
                    if (verifyData.success) {
                        window.location.href = "{{ route('confirmation') }}";
                    } else {
                        showToast("Payment signature verification failed.");
                        btn.disabled = false;
                        btn.innerHTML = originalContent;
                    }
                })
                .catch(err => {
                    console.error(err);
                    showToast("Payment verification failed.");
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                });
            },
            prefill: {
                name: data.customer_name,
                email: data.customer_email,
                contact: data.customer_phone
            },
            theme: {
                color: "#5a0b16" // Maroon
            }
        };

        // Open Razorpay Sandbox Simulator or real gateway
        if (data.key_id === 'rzp_test_mockKeyId12345') {
            showSandboxPaymentModal(data, options, originalContent, btn);
        } else {
            const rzp = new Razorpay(options);
            
            rzp.on('payment.failed', function (response) {
                showToast("Payment Failed: " + (response.error.description || "Transaction declined."));
                btn.disabled = false;
                btn.innerHTML = originalContent;
                console.error("Razorpay payment error:", response.error);
            });

            rzp.open();
        }
    })
    .catch(err => {
        console.error(err);
        showToast("An error occurred during order submission.");
        btn.disabled = false;
        btn.innerHTML = originalContent;
    });
}

// ── Detect Location via Browser GPS + OSM Nominatim ──────────────
function detectLocation() {
    const btn = document.getElementById('detectLocationBtn');
    const statusEl = document.getElementById('locationStatus');

    if (!navigator.geolocation) {
        statusEl.className = 'mt-2 small text-danger';
        statusEl.textContent = '⚠ Geolocation is not supported by your browser.';
        return;
    }

    // Button loading state
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> DETECTING...';
    statusEl.className = 'mt-2 small';
    statusEl.style.color = 'rgba(201,162,75,0.7)';
    statusEl.textContent = '📍 Accessing your device location...';
    statusEl.classList.remove('d-none');

    navigator.geolocation.getCurrentPosition(
        function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            statusEl.textContent = '🔍 Reverse geocoding your coordinates...';

            // Using OpenStreetMap Nominatim (free, no API key needed)
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&accept-language=en`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                const addr = data.address;

                // ── Parse all address components ──────────────────
                const house   = addr.house_number || '';
                const road    = addr.road || '';
                const suburb  = addr.suburb || addr.neighbourhood || addr.quarter || '';
                const village = addr.village || addr.hamlet || '';
                const county  = addr.county || '';
                const city    = addr.city || addr.town || village || county || addr.district || '';
                const state   = addr.state || '';
                const pincode = addr.postcode || '';

                // Build a clean full street address line
                const streetParts = [house, road, suburb].filter(Boolean);
                const streetLine  = streetParts.join(', ');

                // ── Fill ALL fields with detected location ────────
                const fields = {
                    ship_address: streetLine,
                    ship_city:    city,
                    ship_state:   state,
                    ship_pincode: pincode
                };

                Object.entries(fields).forEach(([id, value]) => {
                    if (value) {
                        const el = document.getElementById(id);
                        if (el) {
                            el.value = value;
                            // Gold glow pulse animation
                            el.style.borderColor = 'var(--gold)';
                            el.style.boxShadow   = '0 0 12px rgba(201,162,75,0.35)';
                            setTimeout(() => {
                                el.style.borderColor = '';
                                el.style.boxShadow   = '';
                            }, 3000);
                        }
                    }
                });

                // ── Success message ───────────────────────────────
                statusEl.innerHTML = `
                    <i class="fa-solid fa-circle-check me-1" style="color:var(--gold);"></i>
                    <span style="color:var(--gold-light);">
                        Location filled: <strong>${streetLine || 'N/A'}</strong>,
                        <strong>${city}</strong>,
                        <strong>${state}</strong> – <strong>${pincode}</strong>
                    </span>`;

                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-rotate-right"></i> RE-DETECT';
            })
            .catch(err => {
                statusEl.className = 'mt-2 small';
                statusEl.style.color = '#f87171';
                statusEl.textContent = '⚠ Could not fetch address details. Please fill in manually.';
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-crosshairs"></i> DETECT LOCATION';
            });
        },
        function(error) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-crosshairs"></i> DETECT LOCATION';
            statusEl.className = 'mt-2 small';
            statusEl.style.color = '#f87171';

            switch(error.code) {
                case error.PERMISSION_DENIED:
                    statusEl.textContent = '🔒 Location permission denied. Please allow location access in your browser settings.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    statusEl.textContent = '📡 Location unavailable. Please fill in the address manually.';
                    break;
                case error.TIMEOUT:
                    statusEl.textContent = '⏱ Location request timed out. Please try again.';
                    break;
                default:
                    statusEl.textContent = '⚠ An error occurred. Please fill in the address manually.';
            }
        },
        { timeout: 10000, enableHighAccuracy: true }
    );
}

// ── Custom Sandbox Payment Modal for testing without real credentials ──────────────
function showSandboxPaymentModal(data, options, originalContent, btn) {
    // Create modal overlay
    const overlay = document.createElement('div');
    overlay.id = 'sandboxModalOverlay';
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.background = 'rgba(8, 7, 6, 0.9)';
    overlay.style.backdropFilter = 'blur(10px)';
    overlay.style.display = 'flex';
    overlay.style.alignItems = 'center';
    overlay.style.justifyContent = 'center';
    overlay.style.zIndex = '99999';
    overlay.style.opacity = '0';
    overlay.style.transition = 'opacity 0.25s ease';

    // Modal Card
    const card = document.createElement('div');
    card.style.background = '#181513';
    card.style.border = '1px solid rgba(201, 162, 75, 0.35)';
    card.style.borderRadius = '8px';
    card.style.padding = '2.2rem';
    card.style.maxWidth = '420px';
    card.style.width = '90%';
    card.style.textAlign = 'center';
    card.style.boxShadow = '0 25px 60px rgba(0,0,0,0.6)';
    card.style.transform = 'scale(0.92)';
    card.style.transition = 'transform 0.25s ease';

    card.innerHTML = `
        <div class="mb-3" style="width: 60px; height: 60px; border-radius: 50%; background: rgba(90, 11, 22, 0.35); border: 1px solid rgba(201, 162, 75, 0.25); display: flex; align-items: center; justify-content: center; margin: 0 auto;">
            <i class="fa-solid fa-flask text-gold" style="font-size: 1.6rem;"></i>
        </div>
        <h4 class="font-display text-gold-light mb-2" style="font-weight:700; letter-spacing:0.04em; font-size:1.15rem;">RAZORPAY SANDBOX</h4>
        <p class="small mb-4" style="color:rgba(251,248,241,0.55); font-size:0.78rem; line-height:1.5;">You are currently in development testing mode. Choose how you would like to simulate this transaction.</p>
        
        <div class="p-3 mb-4 rounded text-start" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(201,162,75,0.15);">
            <div class="d-flex justify-content-between mb-2" style="font-size:0.75rem;">
                <span style="color:rgba(251,248,241,0.45);">Order ID:</span>
                <span class="text-gold-light font-monospace" style="font-weight:600;">${data.razorpay_order_id}</span>
            </div>
            <div class="d-flex justify-content-between" style="font-size:0.75rem;">
                <span style="color:rgba(251,248,241,0.45);">Payable Amount:</span>
                <span class="text-gold" style="font-weight:700;">₹${(data.amount / 100).toLocaleString('en-IN', {minimumFractionDigits: 2})}</span>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="button" id="sandboxSuccessBtn" class="btn btn-gold py-2 font-display fw-bold" style="font-size:0.72rem; letter-spacing:0.12em; background:var(--gold); color:var(--bg-black); font-weight:700; border-radius:var(--radius);">
                <i class="fa-solid fa-circle-check me-2"></i> SIMULATE SUCCESS
            </button>
            <button type="button" id="sandboxCancelBtn" class="btn btn-outline-danger py-2 font-display fw-bold" style="font-size:0.72rem; letter-spacing:0.1em; border-radius:var(--radius);">
                <i class="fa-solid fa-circle-xmark me-2"></i> SIMULATE CANCEL
            </button>
        </div>
    `;

    overlay.appendChild(card);
    document.body.appendChild(overlay);

    // Fade In transition
    setTimeout(() => {
        overlay.style.opacity = '1';
        card.style.transform = 'scale(1)';
    }, 20);

    // Success Click
    document.getElementById('sandboxSuccessBtn').onclick = function() {
        overlay.style.opacity = '0';
        card.style.transform = 'scale(0.92)';
        setTimeout(() => {
            overlay.remove();
            options.handler({
                razorpay_payment_id: 'pay_mock_' + Math.random().toString(36).substring(2, 11),
                razorpay_order_id: data.razorpay_order_id,
                razorpay_signature: 'sig_mock_' + Math.random().toString(36).substring(2, 11)
            });
        }, 250);
    };

    // Cancel Click
    document.getElementById('sandboxCancelBtn').onclick = function() {
        overlay.style.opacity = '0';
        card.style.transform = 'scale(0.92)';
        setTimeout(() => {
            overlay.remove();
            if (options.modal && options.modal.ondismiss) {
                options.modal.ondismiss();
            }
        }, 250);
    };
}
</script>
@endpush
