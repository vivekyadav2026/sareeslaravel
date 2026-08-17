@extends('layouts.app')

@section('title', 'Policies & Guidelines — RANISAHAB Luxury Couture')
@section('meta_description', 'Official Store Policies for RANISAHAB: Shipping & Delivery, Returns & Exchanges, Custom Bridal Outfit Guidelines, COD Cancellation Policy, and FAQs.')

@section('content')
<!-- Hero Header -->
<div class="bg-black py-5 border-bottom border-warning border-opacity-25 text-center position-relative">
    <div class="container py-3">
        <span class="badge bg-gold text-dark font-label px-3 py-2 text-uppercase mb-2" style="letter-spacing: 0.15em;">CUSTOMER CARE & LEGAL</span>
        <h1 class="font-display display-5 text-gold mb-3">Policies &amp; Guidelines</h1>
        <p class="lead text-white-50 max-w-700 mx-auto" style="font-size: 0.95rem;">Transparent policies ensuring absolute peace of mind for every bride and luxury fashion connoisseur.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3">
            <div class="card bg-dark border-secondary text-white sticky-top" style="top: 100px; z-index: 10;">
                <div class="card-body p-3">
                    <h6 class="font-label text-gold text-uppercase mb-3 px-2" style="letter-spacing: 0.12em;">Navigation</h6>
                    <div class="nav flex-column nav-pills gap-1">
                        <a href="#shipping" class="nav-link text-white-50 text-start py-2 px-3 rounded hover-gold"><i class="fa-solid fa-truck-fast me-2 text-gold"></i>Shipping &amp; Delivery</a>
                        <a href="#returns" class="nav-link text-white-50 text-start py-2 px-3 rounded hover-gold"><i class="fa-solid fa-rotate-left me-2 text-gold"></i>Returns &amp; Exchanges</a>
                        <a href="#custom-bridal" class="nav-link text-white-50 text-start py-2 px-3 rounded hover-gold"><i class="fa-solid fa-crown me-2 text-gold"></i>Custom Bridal Guidelines</a>
                        <a href="#cod-cancellation" class="nav-link text-white-50 text-start py-2 px-3 rounded hover-gold"><i class="fa-solid fa-ban me-2 text-gold"></i>COD Cancellation Policy</a>
                        <a href="#terms" class="nav-link text-white-50 text-start py-2 px-3 rounded hover-gold"><i class="fa-solid fa-file-contract me-2 text-gold"></i>Terms &amp; Conditions</a>
                        <a href="#privacy" class="nav-link text-white-50 text-start py-2 px-3 rounded hover-gold"><i class="fa-solid fa-shield-halved me-2 text-gold"></i>Privacy Policy</a>
                        <a href="#faq" class="nav-link text-white-50 text-start py-2 px-3 rounded hover-gold"><i class="fa-solid fa-circle-question me-2 text-gold"></i>Frequently Asked Questions</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Shipping & Delivery -->
            <section id="shipping" class="card bg-dark border-secondary text-white mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-truck-fast me-3 text-gold"></i>Shipping &amp; Delivery Policy</h3>
                <hr class="border-secondary mb-3">
                <ul class="text-white-50 small d-grid gap-2 mb-0" style="line-height: 1.7;">
                    <li><strong>Free Express Shipping:</strong> Complimentary Pan-India shipping applies automatically to all orders with a net subtotal of ₹5,000 or above. Flat ₹150 shipping fee applies to orders below ₹5,000.</li>
                    <li><strong>Dispatch Timeline:</strong> Ready-to-ship catalog sarees and designer suits are dispatched within 24 to 48 business hours upon order confirmation.</li>
                    <li><strong>Delivery Timeframe:</strong> Standard Pan-India express delivery typically takes 4 to 7 business days depending on location and courier serviceability.</li>
                    <li><strong>Logistics Partners:</strong> Dispatched via top verified logistics partners including Shiprocket, BlueDart, Delhivery, and DTDC with real-time tracking numbers provided via SMS &amp; Email.</li>
                    <li><strong>Custom &amp; Customized Orders:</strong> Tailored lehengas and bespoke bridal outfits take 15 to 30 business days for hand-weaving, embroidery, and fitting before dispatch.</li>
                </ul>
            </section>

            <!-- Returns & Exchanges -->
            <section id="returns" class="card bg-dark border-secondary text-white mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-rotate-left me-3 text-gold"></i>Returns &amp; Refund Policy</h3>
                <hr class="border-secondary mb-3">
                <ul class="text-white-50 small d-grid gap-2 mb-0" style="line-height: 1.7;">
                    <li><strong>Return Eligibility:</strong> Standard non-customized sarees and unstitched suits can be returned within 7 days of receipt in original condition with tags intact.</li>
                    <li><strong>Damaged / Incorrect Item:</strong> In the rare event of transit damage or wrong item delivery, please notify customer support within 48 hours with an unboxing video/photos for instant replacement or refund.</li>
                    <li><strong>Refund Process:</strong> Approved refunds are credited to the original payment method within 5-7 business days of warehouse verification.</li>
                    <li><strong>Customized Outfits Exemption:</strong> Custom stitched lehengas, bridal packages, and made-to-measure outfits are non-returnable once work has commenced. Free fitting alterations are provided if needed.</li>
                </ul>
            </section>

            <!-- Custom Bridal Guidelines -->
            <section id="custom-bridal" class="card bg-dark border-secondary text-white mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-crown me-3 text-gold"></i>Custom Bridal &amp; Couture Guidelines</h3>
                <hr class="border-secondary mb-3">
                <ul class="text-white-50 small d-grid gap-2 mb-0" style="line-height: 1.7;">
                    <li><strong>"One Design, One Bride" Promise:</strong> Custom bridal pieces marked as <em>Exclusive One-of-a-Kind</em> are crafted exclusively for a single bride and will never be recreated or duplicated for anyone else.</li>
                    <li><strong>Design Certificate:</strong> Every bespoke couture bridal outfit comes with an official signed Physical &amp; Digital Certificate of Authenticity specifying thread composition, artisan hours, and handloom origin.</li>
                    <li><strong>Design Consultation:</strong> Bridal orders include 1-on-1 virtual or in-studio designer consultations to finalize measurements, fabric swatches, color tones, and embroidery motifs.</li>
                </ul>
            </section>

            <!-- COD Cancellation Policy -->
            <section id="cod-cancellation" class="card bg-dark border-secondary text-white mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-ban me-3 text-gold"></i>Cash On Delivery (COD) Cancellation Policy</h3>
                <hr class="border-secondary mb-3">
                <ul class="text-white-50 small d-grid gap-2 mb-0" style="line-height: 1.7;">
                    <li><strong>Free Order Cancellation:</strong> COD orders can be cancelled free of charge within 12 hours of placement or before shipment dispatch by visiting the Order Details page or contacting WhatsApp support.</li>
                    <li><strong>Cancellation Post-Dispatch:</strong> Once a COD order has been dispatched with a courier tracking ID, delivery refusal without valid physical damage justification will result in account COD privilege suspension.</li>
                    <li><strong>Verification Call:</strong> High-value COD orders above ₹10,000 may require a brief telephonic or OTP verification prior to courier dispatch.</li>
                </ul>
            </section>

            <!-- Terms & Conditions -->
            <section id="terms" class="card bg-dark border-secondary text-white mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-file-contract me-3 text-gold"></i>Terms &amp; Conditions</h3>
                <hr class="border-secondary mb-3">
                <p class="text-white-50 small mb-2" style="line-height: 1.7;">By placing an order on RANISAHAB, you agree to our standard terms of service. Product colors may slightly vary due to photographic lighting or monitor screen resolutions. We reserve the right to verify or cancel orders suspected of fraudulent activity.</p>
            </section>

            <!-- Privacy Policy -->
            <section id="privacy" class="card bg-dark border-secondary text-white mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-shield-halved me-3 text-gold"></i>Privacy Policy</h3>
                <hr class="border-secondary mb-3">
                <p class="text-white-50 small mb-0" style="line-height: 1.7;">Your privacy is our utmost priority. We use 256-bit SSL encryption for all transaction data. Personal details such as phone numbers, emails, and shipping addresses are strictly used for order processing, logistics dispatch, and customer support.</p>
            </section>

            <!-- FAQs -->
            <section id="faq" class="card bg-dark border-secondary text-white mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-circle-question me-3 text-gold"></i>Frequently Asked Questions</h3>
                <hr class="border-secondary mb-3">
                <div class="accordion accordion-flush bg-transparent" id="policyFaqAccordion">
                    <div class="accordion-item bg-transparent text-white border-bottom border-secondary border-opacity-25">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-gold font-label py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Are all sarees certified authentic pure handloom?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#policyFaqAccordion">
                            <div class="accordion-body text-white-50 small" style="line-height: 1.6;">
                                Yes! Our handloom sarees carry silk mark / handloom authenticity tagging certified directly from our master weaving clusters in Banaras, Kanchipuram, and Chanderi.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent text-white border-bottom border-secondary border-opacity-25">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-gold font-label py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How do I track my shipment status in real time?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#policyFaqAccordion">
                            <div class="accordion-body text-white-50 small" style="line-height: 1.6;">
                                Enter your Order ID (e.g. RS-XXXXXX) or Mobile Number on our <a href="{{ route('tracking') }}" class="text-gold">Track Order</a> page to view live step-by-step courier updates.
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
