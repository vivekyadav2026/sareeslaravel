@extends('layouts.app')

@section('title', 'Policies & Guidelines — RANISAHAB Luxury Couture')
@section('meta_description', 'Official Store Policies for RANISAHAB: Shipping & Delivery, Returns & Exchanges, Custom Bridal Outfit Guidelines, COD Cancellation Policy, and FAQs.')

@push('styles')
<style>
  /* RANISAHAB Luxury Theme matching for Policies */
  .policies-container {
    background-color: #080706;
    color: var(--ivory);
  }
  
  .policies-card {
    background: #14110f !important;
    border: 1px solid rgba(201, 162, 75, 0.15) !important;
    border-radius: 8px !important;
    color: var(--ivory) !important;
  }

  .policies-card hr {
    border-color: rgba(201, 162, 75, 0.15) !important;
    opacity: 0.8;
  }

  .policies-card p,
  .policies-card li,
  .policies-card ul {
    color: #a89e94 !important;
  }

  .policies-card strong {
    color: var(--gold-light) !important;
  }

  .policies-nav-link {
    color: #a89e94 !important;
    font-family: var(--font-label);
    font-size: 0.72rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    transition: all 0.3s ease;
    border: 1px solid transparent;
  }

  .policies-nav-link:hover,
  .policies-nav-link.active {
    color: var(--gold) !important;
    background: rgba(201, 162, 75, 0.08) !important;
    border-color: rgba(201, 162, 75, 0.25) !important;
  }

  .policies-nav-link i {
    color: var(--gold) !important;
  }

  /* Accordion styles */
  .policies-accordion-item {
    border-color: rgba(201, 162, 75, 0.15) !important;
  }
  .policies-accordion-btn {
    color: var(--gold) !important;
    font-family: var(--font-label);
    font-size: 0.78rem;
    letter-spacing: 0.05em;
  }
  .policies-accordion-btn:not(.collapsed) {
    background-color: rgba(201, 162, 75, 0.05) !important;
    box-shadow: none;
    color: var(--gold) !important;
  }
</style>
@endpush

@section('content')
<div class="policies-container">
  <!-- Hero Header -->
  <div class="bg-black py-5 border-bottom border-warning border-opacity-10 text-center position-relative">
      <div class="container py-3">
          <span class="badge text-dark font-label px-3 py-2 text-uppercase mb-2" style="letter-spacing: 0.15em; background: var(--gold);">CUSTOMER CARE & LEGAL</span>
          <h1 class="font-display display-5 text-gold mb-3">Policies &amp; Guidelines</h1>
          <p class="lead text-white-50 max-w-700 mx-auto" style="font-size: 0.95rem;">Transparent policies ensuring absolute peace of mind for every bride and luxury fashion connoisseur.</p>
      </div>
  </div>

  <div class="container py-5">
      <div class="row g-4">
          <!-- Sidebar Navigation -->
          <div class="col-lg-3">
              <div class="card policies-card sticky-top" style="top: 100px; z-index: 10;">
                  <div class="card-body p-3">
                      <h6 class="font-label text-gold text-uppercase mb-3 px-2" style="letter-spacing: 0.12em;">Navigation</h6>
                      <div class="nav flex-column nav-pills gap-1">
                          <a href="#shipping" class="nav-link policies-nav-link text-start py-2 px-3 rounded"><i class="fa-solid fa-truck-fast me-2"></i>Shipping &amp; Delivery</a>
                          <a href="#returns" class="nav-link policies-nav-link text-start py-2 px-3 rounded"><i class="fa-solid fa-rotate-left me-2"></i>Returns &amp; Exchanges</a>
                          <a href="#custom-bridal" class="nav-link policies-nav-link text-start py-2 px-3 rounded"><i class="fa-solid fa-crown me-2"></i>Custom Bridal Guidelines</a>
                          <a href="#cod-cancellation" class="nav-link policies-nav-link text-start py-2 px-3 rounded"><i class="fa-solid fa-ban me-2"></i>COD Cancellation Policy</a>
                          <a href="#terms" class="nav-link policies-nav-link text-start py-2 px-3 rounded"><i class="fa-solid fa-file-contract me-2"></i>Terms &amp; Conditions</a>
                          <a href="#privacy" class="nav-link policies-nav-link text-start py-2 px-3 rounded"><i class="fa-solid fa-shield-halved me-2"></i>Privacy Policy</a>
                          <a href="#faq" class="nav-link policies-nav-link text-start py-2 px-3 rounded"><i class="fa-solid fa-circle-question me-2"></i>Frequently Asked Questions</a>
                      </div>
                  </div>
              </div>
          </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Shipping & Delivery -->
            <section id="shipping" class="card policies-card mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-truck-fast me-3 text-gold"></i>Shipping &amp; Delivery Policy</h3>
                <hr class="mb-3">
                <ul class="text-white-50 small d-grid gap-2 mb-0" style="line-height: 1.7;">
                    <li><strong>Free Express Shipping:</strong> Complimentary Pan-India shipping applies automatically to all orders with a net subtotal of ₹5,000 or above. Flat ₹150 shipping fee applies to orders below ₹5,000.</li>
                    <li><strong>Dispatch Timeline:</strong> Ready-to-ship catalog sarees and designer suits are dispatched within 24 to 48 business hours upon order confirmation.</li>
                    <li><strong>Delivery Timeframe:</strong> Standard Pan-India express delivery typically takes 4 to 7 business days depending on location and courier serviceability.</li>
                    <li><strong>Logistics Partners:</strong> Dispatched via top verified logistics partners including Shiprocket, BlueDart, Delhivery, and DTDC with real-time tracking numbers provided via SMS &amp; Email.</li>
                    <li><strong>Custom &amp; Customized Orders:</strong> Tailored lehengas and bespoke bridal outfits take 15 to 30 business days for hand-weaving, embroidery, and fitting before dispatch.</li>
                </ul>
            </section>

            <!-- Returns & Exchanges -->
            <section id="returns" class="card policies-card mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-rotate-left me-3 text-gold"></i>Returns &amp; Refund Policy</h3>
                <hr class="mb-3">
                <ul class="text-white-50 small d-grid gap-2 mb-0" style="line-height: 1.7;">
                    <li><strong>Return Eligibility:</strong> Standard non-customized sarees and unstitched suits can be returned within 7 days of receipt in original condition with tags intact.</li>
                    <li><strong>Damaged / Incorrect Item:</strong> In the rare event of transit damage or wrong item delivery, please notify customer support within 48 hours with an unboxing video/photos for instant replacement or refund.</li>
                    <li><strong>Refund Process:</strong> Approved refunds are credited to the original payment method within 5-7 business days of warehouse verification.</li>
                    <li><strong>Customized Outfits Exemption:</strong> Custom stitched lehengas, bridal packages, and made-to-measure outfits are non-returnable once work has commenced. Free fitting alterations are provided if needed.</li>
                </ul>
            </section>

            <!-- Custom Bridal Guidelines -->
            <section id="custom-bridal" class="card policies-card mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-crown me-3 text-gold"></i>Custom Bridal &amp; Couture Guidelines</h3>
                <hr class="mb-3">
                <ul class="text-white-50 small d-grid gap-2 mb-0" style="line-height: 1.7;">
                    <li><strong>"One Design, One Bride" Promise:</strong> Custom bridal pieces marked as <em>Exclusive One-of-a-Kind</em> are crafted exclusively for a single bride and will never be recreated or duplicated for anyone else.</li>
                    <li><strong>Design Certificate:</strong> Every bespoke couture bridal outfit comes with an official signed Physical &amp; Digital Certificate of Authenticity specifying thread composition, artisan hours, and handloom origin.</li>
                    <li><strong>Design Consultation:</strong> Bridal orders include 1-on-1 virtual or in-studio designer consultations to finalize measurements, fabric swatches, color tones, and embroidery motifs.</li>
                </ul>
            </section>

            <!-- COD Cancellation Policy -->
            <section id="cod-cancellation" class="card policies-card mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-ban me-3 text-gold"></i>Cash On Delivery (COD) Cancellation Policy</h3>
                <hr class="mb-3">
                <ul class="text-white-50 small d-grid gap-2 mb-0" style="line-height: 1.7;">
                    <li><strong>Free Order Cancellation:</strong> COD orders can be cancelled free of charge within 12 hours of placement or before shipment dispatch by visiting the Order Details page or contacting WhatsApp support.</li>
                    <li><strong>Cancellation Post-Dispatch:</strong> Once a COD order has been dispatched with a courier tracking ID, delivery refusal without valid physical damage justification will result in account COD privilege suspension.</li>
                    <li><strong>Verification Call:</strong> High-value COD orders above ₹10,000 may require a brief telephonic or OTP verification prior to courier dispatch.</li>
                </ul>
            </section>

            <!-- Terms & Conditions -->
            <section id="terms" class="card policies-card mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-2 d-flex align-items-center"><i class="fa-solid fa-file-contract me-3 text-gold"></i>Exclusive Customer Terms &amp; Commitment</h3>
                <h6 class="text-gold-light font-display font-italic mb-3" style="font-size: 0.9rem;">One Bride. One Design. One Unforgettable Story.</h6>
                <hr class="border-secondary mb-3">
                
                <p class="text-white-50 small mb-3" style="line-height: 1.6;">
                    RANISAHAB का विश्वास है कि शादी का लहंगा, खास suit या saree सिर्फ एक outfit नहीं होता—यह ग्राहक की जिंदगी के सबसे खास पलों की पहचान होता है। इसी विचार के साथ RANISAHAB अपने selected Exclusive Bridal &amp; Occasion Wear को एक विशेष commitment के साथ प्रस्तुत करता है।
                </p>

                <div class="terms-grid d-flex flex-column gap-3">
                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">1. Our Exclusive Promise</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">जब कोई customer RANISAHAB से कोई Exclusive Design खरीदता है और उसका order officially confirm हो जाता है, तो उस exclusive design को उसी customer के लिए reserved माना जाएगा। RANISAHAB उस exact exclusive design को जानबूझकर किसी दूसरे customer के लिए उसी रूप में reproduce या sell नहीं करेगा। हमारा उद्देश्य है कि जिस दिन आप RANISAHAB पहनें, उस दिन आपका outfit आपकी अपनी पहचान बने। (One Bride. One Design.)</p>
                    </div>
                    
                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">2. Exclusive का अर्थ</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">हर RANISAHAB product automatically “Exclusive” नहीं होता। Product page, quotation या order confirmation में यदि किसी product को Exclusive Design के रूप में बताया गया है, तभी उस पर यह exclusive commitment लागू होगा। Regular collection products पर यह commitment लागू नहीं होगा।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">3. Design Reservation</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Exclusive design की exclusivity तभी reserve होगी जब: (1) Customer ने order successfully place किया हो, (2) Applicable payment/advance RANISAHAB को प्राप्त हो गया हो, और (3) RANISAHAB ने order confirmation जारी किया हो। सिर्फ product को cart में add करने या enquiry करने से design reserve नहीं माना जाएगा।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">4. One Customer — One Exclusive Creation</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Exclusive order में customer के लिए चुना गया design, colour combination, embroidery concept या overall look order के अनुसार तैयार किया जा सकता है। Customer द्वारा approved specifications के आधार पर तैयार किए गए final piece को दूसरे customer को identical exclusive piece के रूप में बेचने का उद्देश्य RANISAHAB का नहीं होगा।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">5. Customisation</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">जहाँ applicable हो, customer निम्न में से उपलब्ध options के अनुसार customization request कर सकता है: Size, Measurements, Colour, Fabric, Embroidery, Length, Sleeves, Dupatta, Styling details, या अन्य available design specifications। हर customization हर product में उपलब्ध हो, यह आवश्यक नहीं है।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">6. Measurements</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Custom-fit products के लिए customer द्वारा दिए गए measurements की accuracy अत्यंत महत्वपूर्ण है। Customer द्वारा गलत या incomplete measurements दिए जाने की स्थिति में resulting fitting issue के लिए RANISAHAB की responsibility applicable circumstances के अनुसार निर्धारित होगी। जहाँ संभव हो, final production से पहले important measurements की confirmation ली जा सकती है।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">7. Design Approval</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Custom या highly customised orders के लिए customer से design details की confirmation ली जा सकती है। Customer द्वारा approved design/specifications के बाद production शुरू होने पर requested changes उपलब्धता और applicable charges के अधीन होंगे।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">8. Handmade &amp; Craftsmanship Variation</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">कई RANISAHAB creations में handwork, embroidery, embellishment और artisanal craftsmanship शामिल हो सकता है। इस कारण: embroidery placement में मामूली variation, thread/embellishment में मामूली variation, colour tone में मामूली difference, या handmade finishing में natural variation हो सकता है। ऐसे मामूली variations product की handcrafted character का हिस्सा हो सकते हैं।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">9. Colour &amp; Photography</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Website पर दिखाई गई images lighting, camera, screen settings और photography conditions के कारण actual product के colour से थोड़ी अलग दिखाई दे सकती हैं। हम product information को यथासंभव accurate रखने का प्रयास करते हैं।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">10. Production</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Exclusive और customised products को तैयार करने में regular ready-to-ship products की तुलना में अधिक समय लग सकता है। Estimated production/delivery timeline order confirmation के समय customer को communicate की जाएगी। Unexpected circumstances के कारण reasonable delay होने की स्थिति में RANISAHAB customer को update करने का प्रयास करेगा।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">11. Payment &amp; Order Confirmation</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Order तभी officially confirmed माना जाएगा जब applicable payment/advance RANISAHAB को प्राप्त हो और order confirmation जारी किया जाए। Customer को payment से पहले applicable price, shipping charges, customization charges और अन्य relevant charges की जानकारी दी जा सकती है।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">12. Custom Order Cancellation</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Customised या exclusive products को customer के लिए specially prepare किया जा सकता है। इसलिए production शुरू होने के बाद cancellation, modification, return या refund की eligibility उस particular order की applicable policy और terms पर निर्भर करेगी। Customer को order confirm करने से पहले applicable conditions ध्यानपूर्वक पढ़नी चाहिए।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">13. Return, Exchange &amp; Refund</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Return, exchange और refund केवल RANISAHAB की applicable Return &amp; Refund Policy के अनुसार होंगे। Exclusive/custom-made products के लिए अलग conditions लागू हो सकती हैं। यदि customer को damaged, defective या incorrect product प्राप्त होता है, तो customer को निर्धारित समय के भीतर RANISAHAB Customer Support से संपर्क करना चाहिए।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">14. Damaged or Incorrect Product</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">यदि customer को गलत product, गलत size/product specification, significant manufacturing defect, या transit में materially damaged product प्राप्त होता है, तो customer को निर्धारित समय के भीतर support team को order details और आवश्यक evidence उपलब्ध कराना होगा। RANISAHAB मामले की जांच के बाद applicable resolution प्रदान करेगा।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">15. Delivery</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Delivery address और contact information customer की responsibility है। गलत या incomplete address, unavailable recipient या repeated delivery failure के कारण additional shipping charges लग सकते हैं, जहाँ applicable हो। Delivery timelines estimated होती हैं और courier/service-provider delays के कारण प्रभावित हो सकती हैं।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">16. Customer Privacy</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Customer द्वारा प्रदान किए गए नाम, address, phone number, measurements and order-related information को RANISAHAB अपनी applicable Privacy Policy के अनुसार handle करेगा। Customer measurements जैसी संवेदनशील order information का उपयोग order fulfilment और संबंधित customer service के लिए किया जा सकता है।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">17. Exclusive Design &amp; Marketing</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Exclusive product तैयार करने के बाद RANISAHAB अपने brand portfolio, website, social media या promotional materials में product/design की photographs या videos का उपयोग कर सकता है, subject to applicable privacy commitments. यदि customer की identifiable photograph या personal information promotional purpose के लिए अलग से उपयोग की जानी हो, तो appropriate permission/consent की आवश्यकता हो सकती है।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">18. Design Ownership &amp; Intellectual Property</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">RANISAHAB के logos, brand name, website content, photographs, graphics, original designs, text और अन्य intellectual property RANISAHAB या उसके respective rights holders की property हो सकती है। Customer बिना authorization इन्हें copy, reproduce, commercially use या distribute नहीं कर सकता।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">19. No Unauthorised Reproduction</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">RANISAHAB के exclusive designs, photographs, sketches, concepts या customised creations को बिना written permission commercially reproduce, manufacture या sell करने की अनुमति नहीं है।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">20. Customer Responsibility</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Customer से अपेक्षा की जाती है कि वह: सही contact details दे, सही measurements provide करे, order details verify करे, payment information carefully check करे, delivery के समय product receive करने के लिए reasonable arrangements करे, और order confirmation एवं applicable policies को पढ़े।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">21. Fraudulent Orders</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">RANISAHAB fraudulent, abusive या intentionally misleading orders को cancel करने, restrict करने या appropriate action लेने का अधिकार रखता है। Repeated fake COD orders, payment fraud, chargeback abuse या अन्य misuse के मामलों में customer account/order restrictions लागू की जा सकती हैं।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">22. Product Availability</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">कुछ exclusive, limited या handcrafted products limited quantity में उपलब्ध हो सकते हैं। किसी product का website पर दिखाई देना हमेशा यह guarantee नहीं करता कि वह हर समय available रहेगा।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">23. Offers &amp; Promotions</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Discounts, promotional offers, coupons और special campaigns की अपनी अलग eligibility और validity हो सकती है। एक offer को दूसरे offer के साथ combine करना तभी संभव होगा जब RANISAHAB द्वारा expressly allowed किया गया हो।</p>
                    </div>

                    <div class="term-item pb-2 border-bottom border-secondary border-opacity-10">
                        <span class="text-gold fw-bold small">24. Changes to an Exclusive Design</span>
                        <p class="text-white-50 small mb-0 mt-1" style="line-height: 1.55;">Customer द्वारा approved exclusive design में बाद में major changes की request करने पर original design commitment और production timeline प्रभावित हो सकती है। ऐसे changes additional charges और feasibility के अधीन हो सकते हैं।</p>
                    </div>

                    <div class="term-item pb-2">
                        <span class="text-gold fw-bold small">25. Our Commitment</span>
                        <p class="text-white-50 small mb-2" style="line-height: 1.55;">RANISAHAB का उद्देश्य केवल product deliver करना नहीं है। हम चाहते हैं कि customer को मिले: A thoughtful design, A carefully prepared creation, A premium experience, And a memory worth keeping. हम हर order को सिर्फ एक transaction की तरह नहीं, बल्कि एक खास occasion का हिस्सा मानते हैं।</p>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-black border border-warning border-opacity-25 rounded text-center">
                    <h6 class="text-gold mb-1 font-display fw-bold">Our Promise</h6>
                    <p class="text-gold-light small font-italic mb-2">One Bride. One Design. One Memory.</p>
                    <p class="text-white-50 small mb-0" style="line-height: 1.6;">
                        आपका खास दिन आपका है। आपकी कहानी आपकी है। और जब आप RANISAHAB का Exclusive Creation चुनते हैं—हम उसे आपकी कहानी का हिस्सा बनाने की पूरी कोशिश करते हैं।
                    </p>
                    <span class="d-block mt-2 text-gold fw-bold font-label" style="font-size:0.75rem; letter-spacing:0.1em;">RANISAHAB — Women’s Fashion • Bridal • Luxury • Exclusive Creations</span>
                </div>
            </section>

            <!-- Privacy Policy -->
            <section id="privacy" class="card policies-card mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-shield-halved me-3 text-gold"></i>Privacy Policy</h3>
                <hr class="mb-3">
                <p class="text-white-50 small mb-0" style="line-height: 1.7;">Your privacy is our utmost priority. We use 256-bit SSL encryption for all transaction data. Personal details such as phone numbers, emails, and shipping addresses are strictly used for order processing, logistics dispatch, and customer support.</p>
            </section>

            <!-- FAQs -->
            <section id="faq" class="card policies-card mb-4 p-4 shadow-sm">
                <h3 class="font-display text-gold mb-3 d-flex align-items-center"><i class="fa-solid fa-circle-question me-3 text-gold"></i>Frequently Asked Questions</h3>
                <hr class="mb-3">
                <div class="accordion accordion-flush bg-transparent" id="policyFaqAccordion">
                    <div class="accordion-item bg-transparent text-white policies-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent policies-accordion-btn py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Are all sarees certified authentic pure handloom?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#policyFaqAccordion">
                            <div class="accordion-body small" style="line-height: 1.6;">
                                Yes! Our handloom sarees carry silk mark / handloom authenticity tagging certified directly from our master weaving clusters in Banaras, Kanchipuram, and Chanderi.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent text-white policies-accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent policies-accordion-btn py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How do I track my shipment status in real time?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#policyFaqAccordion">
                            <div class="accordion-body small" style="line-height: 1.6;">
                                Enter your Order ID (e.g. RS-XXXXXX) or Mobile Number on our <a href="{{ route('tracking') }}" class="text-gold">Track Order</a> page to view live step-by-step courier updates.
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
</div>
@endsection
