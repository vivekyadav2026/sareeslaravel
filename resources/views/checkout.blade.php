@extends('layouts.app')

@section('title', 'Secure Checkout — RANISAHAB Luxury')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<div class="bp-page-wrap py-4 py-md-5">
  <div class="container" style="max-width: 960px;">
    
    <!-- Stepper Progress Bar -->
    <div class="checkout-stepper mb-4 mb-md-5">
      <div class="d-flex justify-content-between align-items-center position-relative">
        <div class="stepper-line"></div>
        <div class="stepper-line-active" id="stepperProgressLine" style="width: 0%;"></div>
        
        <div class="step-indicator active" id="stepIndicator1">
          <div class="step-num"><i class="fa-solid fa-cart-shopping"></i></div>
          <span class="step-label">CART</span>
        </div>
        <div class="step-indicator" id="stepIndicator2">
          <div class="step-num"><i class="fa-solid fa-location-dot"></i></div>
          <span class="step-label">ADDRESS</span>
        </div>
        <div class="step-indicator" id="stepIndicator3">
          <div class="step-num"><i class="fa-solid fa-credit-card"></i></div>
          <span class="step-label">PAYMENT</span>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <!-- Left Column: Checkout Panels (Cart / Address / Payment) -->
      <div class="col-lg-7">
        
        <!-- STEP 1: CART PANEL -->
        <div class="checkout-panel" id="panelCart">
          <div class="checkout-card-box p-4">
            <h5 class="font-display text-gold mb-4 border-bottom pb-2">
              <i class="fa-solid fa-bag-shopping me-2"></i>1. SHOPPING BAG ITEMS
            </h5>
            
            <div class="d-flex flex-column gap-3 mb-4">
              @foreach ($cart as $item)
                <div class="d-flex gap-3 align-items-center pb-3 border-bottom border-secondary border-opacity-25 last-no-border" id="cart-item-{{ $item['id'] }}">
                  <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width:70px;height:90px;object-fit:cover;border-radius:4px;border:1px solid rgba(201,162,75,0.25);">
                  
                  <div class="flex-fill">
                    <h6 class="mb-1 text-gold-light fw-bold" style="font-size:0.95rem;">{{ $item['name'] }}</h6>
                    <p class="small text-muted mb-2">Size: <strong class="text-ivory">{{ $item['size'] }}</strong></p>
                    
                    <div class="d-flex align-items-center gap-3">
                      <div class="d-flex align-items-center gap-1">
                        <span class="small text-muted" style="font-size:0.75rem;">Qty:</span>
                        <select class="form-select form-select-sm bg-dark border-secondary text-white py-0 px-2" style="font-size:0.75rem; width:55px;" onchange="updateCartQty('{{ $item['id'] }}', this.value)">
                          @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                          @endfor
                        </select>
                      </div>
                      <button type="button" class="btn btn-sm text-danger border-0 p-0 fs-7" onclick="removeCartItem('{{ $item['id'] }}')" style="font-size:0.75rem;">
                        <i class="fa-solid fa-trash-can me-1"></i> Remove
                      </button>
                    </div>
                  </div>
                  
                  <div class="text-end">
                    <span class="fw-bold text-gold fs-5">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                  </div>
                </div>
              @endforeach
            </div>

            <!-- Gift Wrap Selection -->
            <div class="form-check mt-3 pt-3 border-top border-secondary border-opacity-15">
              <input class="form-check-input" type="checkbox" id="giftWrap" {{ $giftWrapCharge > 0 ? 'checked' : '' }} onchange="toggleGiftWrap(this.checked)">
              <label class="form-check-label small text-ivory opacity-75" for="giftWrap">
                <i class="fa-solid fa-gift text-gold me-2"></i>Add Royal Gift Wrap &nbsp;<span class="text-muted">(₹199 Premium Packaging)</span>
              </label>
            </div>

            <!-- CTA Proceed Button -->
            <div class="mt-4 pt-2">
              <button type="button" onclick="goToStep(2)" class="btn btn-checkout-action w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                PROCEED TO ADDRESS <i class="fa-solid fa-arrow-right-long"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- STEP 2: ADDRESS PANEL -->
        <div class="checkout-panel d-none" id="panelAddress">
          <div class="checkout-card-box p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
              <h5 class="font-display text-gold mb-0"><i class="fa-solid fa-location-dot me-2"></i>2. DELIVERY ADDRESS</h5>
            </div>
            
            <div id="locationStatus" class="alert alert-warning py-2 px-3 small d-none" style="background: rgba(201,162,75,0.05); border: 1px solid rgba(201,162,75,0.25);"></div>

            <form id="addressForm" class="row g-3" onsubmit="event.preventDefault(); goToStep(3);">
              @php
                $googleMapsApiKey = \App\Models\Setting::getVal('google_maps_api_key', env('GOOGLE_MAPS_API_KEY'));
              @endphp

              @if($googleMapsApiKey)
                <div class="col-12 mb-3">
                  <label class="small text-gold-light fw-semibold mb-1"><i class="fa-solid fa-magnifying-glass me-1 text-gold"></i> Search &amp; Auto-Fill Address (via Google Maps)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-secondary text-white border-0"><i class="fa-solid fa-search text-gold"></i></span>
                    <input type="text" id="ship_search_autocomplete" class="form-control form-control-luxury" placeholder="Start typing your home address, building, colony, or area...">
                  </div>
                  <small class="text-muted" style="font-size:0.75rem;">Type your address and select from the dropdown to automatically fill in all fields.</small>
                </div>
                
                <div class="col-12 text-center my-2 position-relative d-flex align-items-center justify-content-center">
                  <hr class="w-100 border-secondary opacity-15">
                  <span class="position-absolute px-3 bg-dark text-muted fw-bold" style="font-size: 0.68rem; letter-spacing: 0.15em; background-color: #0c0a08 !important;">OR</span>
                </div>
              @endif

              <!-- Premium GPS Auto-Detect Location Card -->
              <div class="col-12 mb-3">
                <div onclick="detectLocation()" class="detect-location-card d-flex align-items-center justify-content-between p-3" style="cursor: pointer; background: rgba(197, 168, 128, 0.04); border: 1px dashed rgba(197, 168, 128, 0.25); border-radius: 8px; transition: all 0.3s ease;">
                  <div class="d-flex align-items-center gap-3">
                    <div class="detect-icon-box d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(197, 168, 128, 0.1); border-radius: 50%; color: #c5a880; font-size: 1.1rem; transition: all 0.3s ease;">
                      <i class="fa-solid fa-location-crosshairs"></i>
                    </div>
                    <div>
                      <h6 class="mb-0 text-gold-light fw-bold" style="font-size: 0.88rem; letter-spacing: 0.05em; transition: color 0.3s ease;">USE CURRENT LOCATION</h6>
                      <p class="mb-0 text-muted" style="font-size: 0.72rem;">Autodetects city, state, &amp; pincode via browser GPS</p>
                    </div>
                  </div>
                  <i class="fa-solid fa-chevron-right text-gold opacity-50" style="transition: transform 0.3s ease;"></i>
                </div>
              </div>
              <div class="col-md-6">
                <label class="small text-gold-light fw-semibold mb-1">Full Name <span class="text-danger">*</span></label>
                <input type="text" id="ship_name" class="form-control form-control-luxury" required placeholder="Enter full name" value="{{ $customer ? ($customer->first_name . ' ' . $customer->last_name) : '' }}">
              </div>
              
              <div class="col-md-6">
                <label class="small text-gold-light fw-semibold mb-1">Mobile Number <span class="text-danger">*</span></label>
                <input type="tel" id="ship_phone" class="form-control form-control-luxury" required placeholder="10-digit mobile number" value="{{ $customer->phone ?? '' }}">
              </div>

              <div class="col-12">
                <label class="small text-gold-light fw-semibold mb-1">Email Address <span class="text-danger">*</span></label>
                <input type="email" id="ship_email" class="form-control form-control-luxury" required placeholder="email@example.com" value="{{ $customer->email ?? '' }}">
              </div>

              <div class="col-md-6">
                <label class="small text-gold-light fw-semibold mb-1">House / Building Name <span class="text-danger">*</span></label>
                <input type="text" id="ship_house" class="form-control form-control-luxury" required placeholder="Flat/House No., Building Name" value="{{ explode(', ', $defaultAddress->address_line_1 ?? '')[0] ?? '' }}">
              </div>

              <div class="col-md-6">
                <label class="small text-gold-light fw-semibold mb-1">Street / Area / Colony <span class="text-danger">*</span></label>
                <input type="text" id="ship_street" class="form-control form-control-luxury" required placeholder="Colony, Street Name" value="{{ explode(', ', $defaultAddress->address_line_1 ?? '')[1] ?? '' }}">
              </div>

              <div class="col-md-4">
                <label class="small text-gold-light fw-semibold mb-1">Village / City <span class="text-danger">*</span></label>
                <input type="text" id="ship_city" class="form-control form-control-luxury" required placeholder="City/Town" value="{{ $defaultAddress->city ?? '' }}">
              </div>

              <div class="col-md-4">
                <label class="small text-gold-light fw-semibold mb-1">District <span class="text-danger">*</span></label>
                <input type="text" id="ship_district" class="form-control form-control-luxury" required placeholder="District" value="{{ $defaultAddress->city ?? '' }}">
              </div>

              <div class="col-md-4">
                <label class="small text-gold-light fw-semibold mb-1">State <span class="text-danger">*</span></label>
                <input type="text" id="ship_state" class="form-control form-control-luxury" required placeholder="State" value="{{ $defaultAddress->state ?? '' }}">
              </div>

              <div class="col-12">
                <label class="small text-gold-light fw-semibold mb-1">Pincode <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="text" id="ship_pincode" class="form-control form-control-luxury" required placeholder="6-digit Indian Pincode" value="{{ $defaultAddress->postal_code ?? '' }}">
                  <button class="btn btn-outline-gold font-label fw-bold px-4" type="button" onclick="checkPincodeServiceability()">CHECK SERVICE</button>
                </div>
                <div id="pincodeCheckResult" class="small mt-2 d-none"></div>
              </div>

              <!-- Stepper Back & Next buttons -->
              <div class="col-12 d-flex gap-3 mt-4 pt-2">
                <button type="button" onclick="goToStep(1)" class="btn btn-outline-secondary w-50 py-3 label-title"><i class="fa-solid fa-arrow-left-long me-2"></i> BACK TO CART</button>
                <button type="submit" class="btn btn-checkout-action w-50 py-3">CONTINUE TO PAYMENT <i class="fa-solid fa-arrow-right-long"></i></button>
              </div>
            </form>
          </div>
        </div>

        <!-- STEP 3: PAYMENT PANEL -->
        <div class="checkout-panel d-none" id="panelPayment">
          <div class="checkout-card-box p-4">
            <h5 class="font-display text-gold mb-4 border-bottom pb-2">
              <i class="fa-solid fa-credit-card me-2"></i>3. SELECT PAYMENT METHOD
            </h5>
            
            <!-- Address Summary Block -->
            <div class="p-3 rounded mb-4 text-light opacity-85 small" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(201,162,75,0.15);">
              <h6 class="text-gold mb-1 fw-bold"><i class="fa-solid fa-truck-fast me-2"></i>Delivering To:</h6>
              <p class="mb-0 text-ivory" id="paymentAddressSummary"></p>
            </div>

            <!-- Payment Options -->
            <div class="d-flex flex-column gap-3 mb-4">
              <!-- Online Radio -->
              <div class="payment-method-row selected cursor-pointer" id="payRowOnline" onclick="selectPayMethod('online')">
                <div class="d-flex align-items-center gap-3">
                  <input class="form-check-input mt-0" type="radio" name="paymentTypeOption" checked id="payRadioOnline">
                  <div>
                    <label class="form-check-label fw-bold text-gold-light mb-0" for="payRadioOnline">
                      <i class="fa-solid fa-qrcode me-2 text-gold"></i>Online Payment (Prepaid)
                    </label>
                    <p class="small text-muted mb-0" style="font-size:0.75rem;">100% Safe Checkout: UPI, Credit/Debit Card, Net Banking</p>
                  </div>
                </div>
              </div>

              <!-- COD Radio -->
              <div class="payment-method-row cursor-pointer" id="payRowCOD" onclick="selectPayMethod('cod')">
                <div class="d-flex align-items-center gap-3">
                  <input class="form-check-input mt-0" type="radio" name="paymentTypeOption" id="payRadioCOD">
                  <div>
                    <label class="form-check-label fw-bold text-gold-light mb-0" for="payRadioCOD">
                      <i class="fa-solid fa-hand-holding-dollar me-2 text-gold"></i>Cash on Delivery (COD)
                    </label>
                    <p class="small text-muted mb-0" style="font-size:0.75rem;" id="codLabelText">Pay in cash upon physical delivery.</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Action buttons -->
            <div class="d-flex gap-3">
              <button type="button" onclick="goToStep(2)" class="btn btn-outline-secondary w-50 py-3 label-title"><i class="fa-solid fa-arrow-left-long me-2"></i> BACK TO ADDRESS</button>
              <button type="button" id="placeOrderBtn" onclick="submitSecureOrder()" class="btn btn-checkout-action w-50 py-3 font-display">
                CONFIRM &amp; PAY ₹{{ number_format($total, 0) }}
              </button>
            </div>

          </div>
        </div>

      </div>

      <!-- Right Column: Order Summary (Visible on all steps) -->
      <div class="col-lg-5">
        <div class="checkout-card-box p-4 position-sticky" style="top: 20px;">
          <h5 class="font-display text-gold mb-3 border-bottom pb-2">ORDER SUMMARY</h5>
          
          <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-15 small text-muted">
            <span>Subtotal</span>
            <span class="text-ivory">₹{{ number_format($subtotal, 0) }}</span>
          </div>

          <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-15 small text-muted">
            <span>Gift Packaging</span>
            <span class="text-ivory">₹{{ number_format($giftWrapCharge, 0) }}</span>
          </div>

          <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-15 small text-muted">
            <span>Shipping Charges</span>
            @if ($shipping > 0)
              <span class="text-ivory">₹{{ number_format($shipping, 0) }}</span>
            @else
              <span class="text-success fw-bold">FREE</span>
            @endif
          </div>

          <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-15 small text-muted">
            <span>GST (18% Included)</span>
            <span class="text-ivory">₹{{ number_format($tax, 0) }}</span>
          </div>

          @if ($discount > 0)
            <div class="d-flex justify-content-between py-2 border-bottom border-secondary border-opacity-15 small text-success">
              <span>Coupon Discount</span>
              <span class="fw-bold">−₹{{ number_format($discount, 0) }}</span>
            </div>
          @endif

          <div class="d-flex justify-content-between align-items-baseline pt-3 mt-1 mb-2">
            <strong class="font-display fs-4 text-gold">Grand Total</strong>
            <strong class="font-display fs-3 text-gold" id="grandTotalText">₹{{ number_format($total, 0) }}</strong>
          </div>
          <p class="small text-muted mb-4">Inclusive of all taxes</p>

          <!-- Apply Coupon Input -->
          <div class="pt-3 border-top border-secondary border-opacity-25">
            <p class="small fw-bold text-gold-light mb-2">APPLY COUPON</p>
            <div class="input-group mb-2">
              <input type="text" id="couponInput" class="form-control bg-dark border-secondary text-white text-uppercase" style="font-size:0.8rem;" value="{{ session('coupon_code', '') }}" placeholder="Enter Coupon Code">
              @if(session('coupon_code'))
                <button class="btn btn-danger font-label px-3" type="button" onclick="removeCoupon()">REMOVE</button>
              @else
                <button class="btn btn-gold font-label px-3" type="button" onclick="applyCoupon()">APPLY</button>
              @endif
            </div>
            <div id="couponMessage" class="small">
              @if(session('coupon_code'))
                <span class="text-success"><i class="fa-solid fa-circle-check me-1"></i>Coupon '{{ session('coupon_code') }}' applied successfully!</span>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<!-- Auth Required Modal for Guest Checkout -->
<div class="modal fade" id="checkoutAuthModal" tabindex="-1" aria-labelledby="checkoutAuthModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-white" style="background: linear-gradient(145deg, #181410 0%, #0c0a08 100%); border: 1px solid rgba(201, 162, 75, 0.4); border-radius: 12px; box-shadow: 0 15px 40px rgba(0,0,0,0.8);">
      <div class="modal-header border-bottom border-warning border-opacity-25 pb-3">
        <h5 class="modal-title font-display text-gold d-flex align-items-center gap-2" id="checkoutAuthModalLabel">
          <i class="fa-solid fa-lock text-gold"></i> LOGIN REQUIRED TO CONTINUE
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center py-4 px-4">
        <div class="mb-3">
          <i class="fa-solid fa-crown text-gold" style="font-size: 2.8rem; filter: drop-shadow(0 0 10px rgba(201,162,75,0.4));"></i>
        </div>
        <h6 class="font-display text-gold mb-2" style="font-size: 1.2rem; color: #c9a24b !important;">Please Log In to Complete Your Order</h6>
        <p class="small text-white opacity-90 mb-4" style="line-height: 1.6; color: #ffffff !important; font-size: 0.9rem;">
          To ensure secure order tracking, reward points, and royal service, please log in with your email address or create a new account before entering your delivery address.
        </p>

        <div class="d-grid gap-3">
          <a href="{{ route('customer.login') }}" class="btn btn-gold py-3 fw-bold font-label text-dark" style="letter-spacing: 0.1em; background: linear-gradient(90deg, #c5a880 0%, #b2946c 100%); border: none;">
            <i class="fa-solid fa-right-to-bracket me-2"></i> LOGIN WITH EMAIL
          </a>
          
          <a href="{{ route('customer.google.redirect') }}" class="d-flex align-items-center justify-content-center gap-2 w-100 py-3 rounded-2 text-decoration-none"
             style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); color: #e2d9c8; font-size: 0.88rem; letter-spacing: 0.08em; text-transform: uppercase; font-weight: 600; transition: background 0.2s, border-color 0.2s;"
             onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(203,166,110,0.5)'"
             onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.15)'">
             <svg width="20" height="20" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" class="me-1">
                 <path fill="#EA4335" d="M24 9.5c3.2 0 5.9 1.1 8.1 2.9l6-6C34.5 3.1 29.6 1 24 1 14.9 1 7.1 6.6 3.6 14.5l7 5.4C12.4 13.7 17.7 9.5 24 9.5z"/>
                 <path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h12.7c-.5 2.8-2.2 5.2-4.7 6.8l7.3 5.7C43.6 37 46.5 31.2 46.5 24.5z"/>
                 <path fill="#FBBC05" d="M10.6 28.1A14.6 14.6 0 0 1 9.5 24c0-1.4.2-2.8.6-4.1l-7-5.4A23.9 23.9 0 0 0 0 24c0 3.9.9 7.5 2.6 10.8l7.3-5.7c-.2-.6-.3-1.3-.3-1z"/>
                 <path fill="#34A853" d="M24 47c5.6 0 10.3-1.8 13.7-5l-7.3-5.7c-1.9 1.3-4.3 2.1-6.4 2.1-6.3 0-11.6-4.2-13.5-9.9l-7.3 5.7C7.1 41.4 14.9 47 24 47z"/>
             </svg>
             Continue with Google
          </a>

          <a href="{{ route('customer.register') }}" class="btn btn-outline-gold py-3 fw-bold font-label" style="letter-spacing: 0.1em; border-color: #c9a24b; color: #f3dfb2;">
            <i class="fa-solid fa-user-plus me-2"></i> CREATE NEW ACCOUNT
          </a>
        </div>
      </div>
      <div class="modal-footer border-top border-warning border-opacity-15 justify-content-center py-2">
        <span class="small text-white opacity-75" style="font-size: 0.78rem; color: rgba(255,255,255,0.85) !important;"><i class="fa-solid fa-shield-halved me-1 text-gold"></i> 100% Encrypted &amp; Secure Checkout</span>
      </div>
    </div>
  </div>
</div>

@endsection

@push('styles')
<style>
  /* Premium Dark Theme Overrides for secure checkout panel page layout */
  .bp-page-wrap {
      background-color: #080706;
      color: #f5f0eb !important;
      min-height: 100vh;
  }
  
  .bp-page-wrap .text-muted {
      color: rgba(255, 255, 255, 0.70) !important;
  }
  .bp-page-wrap .text-gold-light {
      color: #f3dfb2 !important;
  }
  .bp-page-wrap .text-ivory {
      color: #ffffff !important;
  }
  .bp-page-wrap label {
      color: #f3dfb2 !important;
      font-weight: 500;
  }
  
  .checkout-card-box {
      background: linear-gradient(145deg, #16120e 0%, #0b0907 100%);
      border: 1px solid rgba(201, 162, 75, 0.25) !important;
      border-radius: 8px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
  }

  /* Stepper Progress Bar */
  .checkout-stepper {
      max-width: 580px;
      margin: 0 auto;
  }
  .stepper-line {
      position: absolute;
      top: 22px;
      left: 10%;
      width: 80%;
      height: 2px;
      background: rgba(255, 255, 255, 0.15);
      z-index: 1;
  }
  .stepper-line-active {
      position: absolute;
      top: 22px;
      left: 10%;
      height: 2px;
      background: var(--gold);
      z-index: 1;
      transition: width 0.35s ease;
  }
  .step-indicator {
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      z-index: 2;
      width: 60px;
      cursor: pointer;
  }
  .step-num {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: #1c1815;
      border: 1px solid rgba(201, 162, 75, 0.35);
      color: rgba(255,255,255,0.6);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.95rem;
      transition: all 0.3s ease;
  }
  .step-label {
      font-family: var(--font-label);
      font-size: 0.68rem;
      letter-spacing: 0.12em;
      margin-top: 0.5rem;
      color: rgba(255,255,255,0.6);
      font-weight: 700;
  }
  .step-indicator.active .step-num {
      background: var(--gold);
      border-color: var(--gold);
      color: #000;
      box-shadow: 0 0 12px var(--gold);
  }
  .step-indicator.active .step-label {
      color: var(--gold);
  }
  .step-indicator.done .step-num {
      background: #130f0c;
      border-color: var(--gold);
      color: var(--gold);
  }
  .step-indicator.done .step-label {
      color: var(--gold-light);
  }

  /* Luxury Form Inputs */
  .form-control-luxury {
      background: rgba(255, 255, 255, 0.05) !important;
      border: 1px solid rgba(201, 162, 75, 0.35) !important;
      color: #ffffff !important;
      padding: 0.78rem 1rem !important;
      border-radius: 4px !important;
      font-size: 0.92rem !important;
      transition: all 0.3s ease !important;
  }
  .form-control-luxury::placeholder {
      color: rgba(255, 255, 255, 0.45) !important;
  }
  .form-control-luxury:focus {
      background: rgba(255, 255, 255, 0.08) !important;
      border-color: var(--gold) !important;
      box-shadow: 0 0 12px rgba(201, 162, 75, 0.3) !important;
      color: #ffffff !important;
  }

  .bp-page-wrap .btn-outline-secondary {
      border: 1px solid rgba(197, 168, 128, 0.6) !important;
      color: #ffffff !important;
      background: rgba(255, 255, 255, 0.06) !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4) !important;
  }
  .bp-page-wrap .btn-outline-secondary:hover {
      background: rgba(197, 168, 128, 0.18) !important;
      border-color: #ffffff !important;
      color: #ffffff !important;
      box-shadow: 0 4px 15px rgba(197, 168, 128, 0.25) !important;
  }

  /* Payment Method Row */
  .payment-method-row {
      border: 1px solid rgba(201, 162, 75, 0.25);
      background: rgba(255, 255, 255, 0.02);
      border-radius: 6px;
      padding: 1.1rem;
      transition: all 0.3s ease;
  }
  .payment-method-row:hover,
  .payment-method-row.selected {
      border-color: var(--gold);
      background: rgba(201, 162, 75, 0.1);
  }

  /* Checkout Main action gold gradient CTA button */
  .btn-checkout-action {
      background: linear-gradient(90deg, #e3cfa8 0%, #c5a880 100%) !important;
      color: #000000 !important;
      font-family: var(--font-label) !important;
      font-weight: 700 !important;
      letter-spacing: 0.1em !important;
      border: none !important;
      border-radius: 4px !important;
      transition: all 0.3s ease !important;
      box-shadow: 0 4px 15px rgba(197, 168, 128, 0.3) !important;
  }
  .btn-checkout-action:hover {
      background: linear-gradient(90deg, #f5e3c3 0%, #dcc29b 100%) !important;
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(197, 168, 128, 0.5) !important;
  }
  
  /* Premium Detect Location Card Styles */
  .detect-location-card {
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
  }
  .detect-location-card:hover {
      background: rgba(197, 168, 128, 0.08) !important;
      border: 1px solid rgba(197, 168, 128, 0.5) !important;
      box-shadow: 0 4px 15px rgba(197, 168, 128, 0.1) !important;
  }
  .detect-location-card:hover .detect-icon-box {
      background: rgba(197, 168, 128, 0.2) !important;
      color: #ffffff !important;
      transform: scale(1.05);
  }
  .detect-location-card:hover .text-gold-light {
      color: #ffffff !important;
  }
  .detect-location-card:hover .fa-chevron-right {
      transform: translateX(4px);
      opacity: 1 !important;
  }

  @media (max-width: 575.98px) {
      /* Make checkout step navigation buttons more compact on mobile */
      .bp-page-wrap .btn-checkout-action,
      .bp-page-wrap .btn-outline-secondary.label-title,
      .bp-page-wrap #placeOrderBtn {
          padding-top: 0.65rem !important;
          padding-bottom: 0.65rem !important;
          font-size: 0.78rem !important;
          letter-spacing: 0.05em !important;
      }
  }
</style>
@endpush

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
// Stepper Navigation State
let currentStep = 1;
let selectedPaymentMethod = 'online';
let isCODAvailable = true; // Serviced by default, validated on pincode check
const grandTotalVal = {{ $total }};

document.addEventListener('DOMContentLoaded', function() {
    // 1. Auto-fill Address Fields from LocalStorage to prevent accidental loss
    const fieldsToStore = ['ship_name', 'ship_phone', 'ship_email', 'ship_house', 'ship_street', 'ship_city', 'ship_district', 'ship_state', 'ship_pincode'];
    fieldsToStore.forEach(fieldId => {
        const saved = localStorage.getItem('rs_checkout_' + fieldId);
        if (saved) {
            const input = document.getElementById(fieldId);
            if (input && !input.value) {
                input.value = saved;
            }
        }
        
        // Listen to changes to save immediately
        const input = document.getElementById(fieldId);
        if (input) {
            input.addEventListener('input', function() {
                localStorage.setItem('rs_checkout_' + fieldId, this.value);
            });
        }
    });

    // Make step indicators clickable to go back
    document.getElementById('stepIndicator1').addEventListener('click', () => { if (currentStep > 1) goToStep(1); });
    document.getElementById('stepIndicator2').addEventListener('click', () => { if (currentStep > 2) goToStep(2); });
});

// Stepper controller
function goToStep(stepNum) {
    const isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
    
    // Require email login before proceeding to address or payment step
    if (stepNum > 1 && !isAuthenticated) {
        const authModal = new bootstrap.Modal(document.getElementById('checkoutAuthModal'));
        authModal.show();
        return;
    }

    // Validate inputs if proceeding from Step 2 to Step 3
    if (stepNum === 3 && currentStep === 2) {
        const name = document.getElementById('ship_name').value;
        const phone = document.getElementById('ship_phone').value;
        const email = document.getElementById('ship_email').value;
        const house = document.getElementById('ship_house').value;
        const street = document.getElementById('ship_street').value;
        const city = document.getElementById('ship_city').value;
        const state = document.getElementById('ship_state').value;
        const pincode = document.getElementById('ship_pincode').value;

        if (!name || !phone || !email || !house || !street || !city || !state || !pincode) {
            showToast("Please fill in all required shipping address fields.");
            return;
        }
        
        // Populate Payment Summary address block
        const fullAddress = `${house}, ${street}, ${city}, ${state} - ${pincode}`;
        document.getElementById('paymentAddressSummary').innerHTML = `<i class="fa-solid fa-address-card text-gold me-2"></i>${name} | ${phone}<br><span class="opacity-75">${fullAddress}</span>`;
    }

    currentStep = stepNum;

    // Hide all step panels
    document.getElementById('panelCart').classList.add('d-none');
    document.getElementById('panelAddress').classList.add('d-none');
    document.getElementById('panelPayment').classList.add('d-none');

    // Update active panel
    if (currentStep === 1) {
        document.getElementById('panelCart').classList.remove('d-none');
        document.getElementById('stepperProgressLine').style.width = '0%';
        
        document.getElementById('stepIndicator1').className = 'step-indicator active';
        document.getElementById('stepIndicator2').className = 'step-indicator';
        document.getElementById('stepIndicator3').className = 'step-indicator';
    } else if (currentStep === 2) {
        document.getElementById('panelAddress').classList.remove('d-none');
        document.getElementById('stepperProgressLine').style.width = '50%';
        
        document.getElementById('stepIndicator1').className = 'step-indicator done';
        document.getElementById('stepIndicator2').className = 'step-indicator active';
        document.getElementById('stepIndicator3').className = 'step-indicator';
    } else if (currentStep === 3) {
        document.getElementById('panelPayment').classList.remove('d-none');
        document.getElementById('stepperProgressLine').style.width = '100%';
        
        document.getElementById('stepIndicator1').className = 'step-indicator done';
        document.getElementById('stepIndicator2').className = 'step-indicator done';
        document.getElementById('stepIndicator3').className = 'step-indicator active';
    }
    
    // Scroll window smoothly to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Check Pincode Serviceability
function checkPincodeServiceability() {
    const pincode = document.getElementById('ship_pincode').value;
    const resultEl = document.getElementById('pincodeCheckResult');
    
    if (!pincode || pincode.length < 6) {
        resultEl.className = 'small mt-2 text-danger';
        resultEl.innerHTML = '<i class="fa-solid fa-circle-exclamation me-1"></i>Please enter a valid 6-digit Pincode.';
        resultEl.classList.remove('d-none');
        return;
    }

    resultEl.className = 'small mt-2 text-muted';
    resultEl.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i>Checking delivery serviceability...';
    resultEl.classList.remove('d-none');

    fetch("{{ route('checkout.check-pincode') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ pincode: pincode })
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            resultEl.className = 'small mt-2 text-danger';
            resultEl.innerHTML = `<i class="fa-solid fa-circle-xmark me-1"></i>${data.message}`;
            isCODAvailable = false;
            // Disable COD row option
            document.getElementById('payRowCOD').style.opacity = '0.3';
            document.getElementById('payRowCOD').style.pointerEvents = 'none';
            selectPayMethod('online');
            return;
        }

        isCODAvailable = data.cod_available;
        resultEl.className = 'small mt-2 text-success';
        
        if (isCODAvailable) {
            resultEl.innerHTML = `<i class="fa-solid fa-circle-check me-1"></i>✓ Delivery & COD Available via ${data.courier_name} (Est: ${data.estimated_days})`;
            document.getElementById('payRowCOD').style.opacity = '1';
            document.getElementById('payRowCOD').style.pointerEvents = 'auto';
            document.getElementById('codLabelText').innerText = 'Pay in cash upon physical delivery.';
        } else {
            resultEl.innerHTML = `<i class="fa-solid fa-circle-check me-1"></i>✓ Delivery Available. COD is not available for this pincode.`;
            document.getElementById('payRowCOD').style.opacity = '0.3';
            document.getElementById('payRowCOD').style.pointerEvents = 'none';
            document.getElementById('codLabelText').innerText = 'COD not eligible for this pincode.';
            selectPayMethod('online');
        }
    })
    .catch(err => {
        resultEl.className = 'small mt-2 text-danger';
        resultEl.innerHTML = '❌ Pincode check failed. Please enter again.';
    });
}

// Payment method switcher
function selectPayMethod(method) {
    selectedPaymentMethod = method;
    const btn = document.getElementById('placeOrderBtn');

    if (selectedPaymentMethod === 'online') {
        document.getElementById('payRowOnline').classList.add('selected');
        document.getElementById('payRowCOD').classList.remove('selected');
        document.getElementById('payRadioOnline').checked = true;
        
        btn.innerHTML = `CONFIRM & PAY ₹${grandTotalVal.toLocaleString('en-IN')}`;
    } else {
        document.getElementById('payRowOnline').classList.remove('selected');
        document.getElementById('payRowCOD').classList.add('selected');
        document.getElementById('payRadioCOD').checked = true;
        
        btn.innerHTML = `CONFIRM ORDER • ₹${grandTotalVal.toLocaleString('en-IN')} COD`;
    }
}

// Submit Order placement Form
function submitSecureOrder() {
    const btn = document.getElementById('placeOrderBtn');
    const originalContent = btn.innerHTML;

    const name = document.getElementById('ship_name').value;
    const phone = document.getElementById('ship_phone').value;
    const email = document.getElementById('ship_email').value;
    const house = document.getElementById('ship_house').value;
    const street = document.getElementById('ship_street').value;
    const city = document.getElementById('ship_city').value;
    const district = document.getElementById('ship_district').value;
    const state = document.getElementById('ship_state').value;
    const pincode = document.getElementById('ship_pincode').value;

    const fullAddress = `${house}, ${street}, ${district}`;

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin fs-5"></i> PROCESSING ORDER...';

    const payload = {
        name: name,
        phone: phone,
        email: email,
        address: fullAddress,
        city: city,
        state: state,
        pincode: pincode,
        payment_method: selectedPaymentMethod === 'cod' ? 'cod' : 'upi_razorpay'
    };

    fetch("{{ route('checkout.place') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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

        // Clear local storage address on successful placement
        const fieldsToStore = ['ship_name', 'ship_phone', 'ship_email', 'ship_house', 'ship_street', 'ship_city', 'ship_district', 'ship_state', 'ship_pincode'];
        fieldsToStore.forEach(f => localStorage.removeItem('rs_checkout_' + f));

        if (!data.payment_required) {
            // Cash on delivery redirects to confirmation page directly
            window.location.href = data.redirect_url;
            return;
        }

        // Razorpay Gateway Options
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
                
                // Verify payment signature checks with backend callback
                fetch("{{ route('checkout.payment-verify') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
                color: "#c5a880"
            }
        };

        // Open Razorpay Sandbox or real gateway
        if (data.key_id === 'rzp_test_mockKeyId12345') {
            showSandboxPaymentModal(data, options, originalContent, btn);
        } else {
            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function (response) {
                showToast("Payment Failed: " + (response.error.description || "Declined."));
                btn.disabled = false;
                btn.innerHTML = originalContent;
            });
            rzp.open();
        }
    })
    .catch(err => {
        showToast("An error occurred during order submission.");
        btn.disabled = false;
        btn.innerHTML = originalContent;
    });
}

// ── Detect Location via Browser GPS + OSM Nominatim ──────────────
function detectLocation() {
    const statusEl = document.getElementById('locationStatus');
    const detectIcon = document.querySelector('.detect-icon-box i');
    const detectCard = document.querySelector('.detect-location-card');

    if (!navigator.geolocation) {
        statusEl.className = 'alert alert-danger py-2 px-3 small';
        statusEl.textContent = 'Geolocation is not supported by your browser.';
        statusEl.classList.remove('d-none');
        return;
    }

    statusEl.className = 'alert alert-info py-2 px-3 small';
    statusEl.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Accessing your location...';
    statusEl.classList.remove('d-none');

    // Add loading animations to the card
    if (detectIcon) {
        detectIcon.className = 'fa-solid fa-location-crosshairs fa-spin text-gold';
    }
    if (detectCard) {
        detectCard.style.pointerEvents = 'none';
        detectCard.style.opacity = '0.7';
    }

    navigator.geolocation.getCurrentPosition(
        function(position) {
            // Restore icon and card status
            if (detectIcon) detectIcon.className = 'fa-solid fa-location-crosshairs';
            if (detectCard) {
                detectCard.style.pointerEvents = 'auto';
                detectCard.style.opacity = '1';
            }

            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&accept-language=en`)
            .then(res => res.json())
            .then(data => {
                const addr = data.address;

                const house   = addr.house_number || '';
                const road    = addr.road || '';
                const suburb  = addr.suburb || addr.neighbourhood || '';
                const village = addr.village || addr.hamlet || '';
                const county  = addr.county || '';
                const city    = addr.city || addr.town || village || county || '';
                const state   = addr.state || '';
                const pincode = addr.postcode || '';

                // Fill inputs
                document.getElementById('ship_house').value = house;
                document.getElementById('ship_street').value = [road, suburb].filter(Boolean).join(', ');
                document.getElementById('ship_city').value = city;
                document.getElementById('ship_district').value = county || city;
                document.getElementById('ship_state').value = state;
                document.getElementById('ship_pincode').value = pincode;

                // Sync with localStorage
                const fields = ['ship_house', 'ship_street', 'ship_city', 'ship_district', 'ship_state', 'ship_pincode'];
                fields.forEach(f => {
                    localStorage.setItem('rs_checkout_' + f, document.getElementById(f).value);
                });

                statusEl.className = 'alert alert-success py-2 px-3 small';
                statusEl.innerHTML = '<i class="fa-solid fa-circle-check me-2"></i>Location detected and filled successfully!';
                
                // Trigger pincode check automatically on successful geolocation fill
                checkPincodeServiceability();
            })
            .catch(err => {
                statusEl.className = 'alert alert-danger py-2 px-3 small';
                statusEl.textContent = 'Could not reverse geocode location. Please fill manually.';
            });
        },
        function(err) {
            // Restore icon and card status
            if (detectIcon) detectIcon.className = 'fa-solid fa-location-crosshairs';
            if (detectCard) {
                detectCard.style.pointerEvents = 'auto';
                detectCard.style.opacity = '1';
            }
            statusEl.className = 'alert alert-danger py-2 px-3 small';
            statusEl.textContent = 'Location access denied or timed out. Please enter address manually.';
        }
    );
}

// Custom Sandbox simulator modal
function showSandboxPaymentModal(data, options, originalContent, btn) {
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = '0';
    overlay.style.left = '0';
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.background = 'rgba(8, 7, 6, 0.95)';
    overlay.style.display = 'flex';
    overlay.style.alignItems = 'center';
    overlay.style.justifyContent = 'center';
    overlay.style.zIndex = '99999';
    
    const card = document.createElement('div');
    card.style.background = '#130f0c';
    card.style.border = '1px solid #c5a880';
    card.style.borderRadius = '8px';
    card.style.padding = '2rem';
    card.style.width = '380px';
    card.style.color = '#fff';
    card.style.textAlign = 'center';
    
    card.innerHTML = `
        <h5 class="text-gold font-display mb-3">RAZORPAY PAYMENT GATEWAY</h5>
        <p class="small text-muted mb-2">Simulated Sandbox Environment</p>
        <p class="fw-bold mb-4" style="font-size:1.1rem; color:var(--gold-light);">Total: ₹${grandTotalVal.toLocaleString('en-IN')}</p>
        <div class="d-flex flex-column gap-2">
            <button id="sandPaySuccess" class="btn btn-success py-2 font-label fw-bold">✓ AUTHORIZE SUCCESS</button>
            <button id="sandPayFail" class="btn btn-danger py-2 font-label fw-bold">❌ SIMULATE FAILURE</button>
        </div>
    `;
    
    overlay.appendChild(card);
    document.body.appendChild(overlay);
    
    document.getElementById('sandPaySuccess').onclick = function() {
        document.body.removeChild(overlay);
        options.handler({
            razorpay_payment_id: 'pay_mock_' + Math.random().toString(36).substring(7),
            razorpay_order_id: data.razorpay_order_id,
            razorpay_signature: 'signature_verified_mock'
        });
    };
    
    document.getElementById('sandPayFail').onclick = function() {
        document.body.removeChild(overlay);
        showToast("Payment transaction simulated as failed.");
        btn.disabled = false;
        btn.innerHTML = originalContent;
    };
}

function updateCartQty(productId, qty) {
    fetch("{{ route('cart.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    });
}
</script>

@if($googleMapsApiKey)
<script src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsApiKey }}&libraries=places&callback=initAutocomplete" async defer></script>
<script>
function initAutocomplete() {
    const autocompleteInput = document.getElementById('ship_search_autocomplete');
    if (!autocompleteInput) return;

    const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, {
        types: ['address'],
        componentRestrictions: { country: 'in' }
    });

    google.maps.event.addDomListener(autocompleteInput, 'keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });

    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        if (!place.address_components) return;

        let streetNumber = '';
        let route = '';
        let sublocality = '';
        let locality = '';
        let city = '';
        let district = '';
        let state = '';
        let pincode = '';

        for (const component of place.address_components) {
            const componentType = component.types[0];

            switch (componentType) {
                case 'street_number':
                    streetNumber = component.long_name;
                    break;
                case 'route':
                    route = component.long_name;
                    break;
                case 'sublocality_level_1':
                case 'sublocality_level_2':
                case 'sublocality':
                    if (sublocality) sublocality += ', ';
                    sublocality += component.long_name;
                    break;
                case 'locality':
                    locality = component.long_name;
                    break;
                case 'administrative_area_level_2':
                    district = component.long_name;
                    break;
                case 'administrative_area_level_1':
                    state = component.long_name;
                    break;
                case 'postal_code':
                    pincode = component.long_name;
                    break;
            }
        }

        city = locality || sublocality || '';
        if (!district) district = city;

        const streetAddress = [route, sublocality].filter(Boolean).join(', ');

        if (streetNumber) {
            document.getElementById('ship_house').value = streetNumber;
        }
        document.getElementById('ship_street').value = streetAddress;
        document.getElementById('ship_city').value = city;
        document.getElementById('ship_district').value = district;
        document.getElementById('ship_state').value = state;
        document.getElementById('ship_pincode').value = pincode;

        const fields = ['ship_house', 'ship_street', 'ship_city', 'ship_district', 'ship_state', 'ship_pincode'];
        fields.forEach(f => {
            localStorage.setItem('rs_checkout_' + f, document.getElementById(f).value);
        });

        checkPincodeServiceability();
    });
}
</script>
@endif
@endpush
