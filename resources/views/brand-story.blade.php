@extends('layouts.app')

@section('title', 'Brand Story — RANISAHAB: तीन दोस्तों के सपने की कहानी')
@section('meta_description', 'RANISAHAB की कहानी — नवीन नवरंगे, गजेंद्र मारकंडे और ओंकार बंजारे के संघर्ष, अटूट दोस्ती, आत्म-विकास और सपनों को हकीकत में बदलने की प्रेरणादायक यात्रा।')
@section('meta_keywords', 'ranisahab brand story, ranisahab founder, naveen navrange, gajendra markande, omkar banjare, brand origin story, luxury fashion journey')

@push('styles')
<style>
  /* Compact Custom split hero overrides */
  .dark-split-hero {
    padding: 1.5rem 0 !important;
  }
  @media (min-width: 992px) {
    .dark-split-hero {
      padding: 2.5rem 0 !important;
    }
  }

  /* Custom Luxury Timeline Styling */
  .luxury-timeline {
    position: relative;
    max-width: 900px;
    margin: 2rem auto;
    padding: 0 1.2rem;
  }
  
  .luxury-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 18px;
    width: 2px;
    background: linear-gradient(180deg, var(--gold) 0%, rgba(201, 162, 75, 0.4) 50%, rgba(201, 162, 75, 0.05) 100%);
  }
  
  @media (min-width: 768px) {
    .luxury-timeline::before {
      left: 50%;
      transform: translateX(-50%);
    }
  }

  .timeline-item {
    position: relative;
    margin-bottom: 2.2rem;
  }
  
  .timeline-item::after {
    content: "";
    display: table;
    clear: both;
  }

  .timeline-badge {
    position: absolute;
    top: 0;
    left: 2px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #0f0b09;
    border: 2px solid var(--gold);
    color: var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    z-index: 10;
    box-shadow: 0 0 12px rgba(201, 162, 75, 0.35);
    transition: all 0.3s ease;
  }
  
  .timeline-item:hover .timeline-badge {
    transform: scale(1.1);
    background: var(--gold);
    color: #0f0b09;
    box-shadow: 0 0 18px rgba(201, 162, 75, 0.55);
  }
  
  @media (min-width: 768px) {
    .timeline-badge {
      left: 50%;
      margin-left: -16px;
    }
  }

  .timeline-panel {
    width: 100%;
    float: right;
    padding-left: 40px;
    position: relative;
  }
  
  @media (min-width: 768px) {
    .timeline-panel {
      width: 45%;
      float: left;
      padding-left: 0;
      padding-right: 25px;
      text-align: right;
    }
    
    .timeline-item.inverted .timeline-panel {
      float: right;
      padding-left: 25px;
      padding-right: 0;
      text-align: left;
    }
  }

  .timeline-content {
    background: #14110f;
    border: 1px solid rgba(201, 162, 75, 0.15);
    border-radius: 8px;
    padding: 1.1rem 1.3rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  }
  
  .timeline-content:hover {
    border-color: var(--gold);
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(201, 162, 75, 0.15);
  }
  
  .timeline-year {
    font-family: var(--font-label);
    font-size: 0.65rem;
    color: var(--gold);
    letter-spacing: 0.12em;
    margin-bottom: 0.4rem;
    font-weight: 700;
    text-transform: uppercase;
    display: inline-block;
    padding: 0.15rem 0.5rem;
    background: rgba(201, 162, 75, 0.08);
    border-radius: 4px;
    border: 1px solid rgba(201, 162, 75, 0.2);
  }
  
  .timeline-title {
    font-family: var(--font-label);
    font-size: 1.05rem;
    color: var(--gold-light);
    margin-bottom: 0.6rem;
    letter-spacing: 0.05em;
  }
  
  .timeline-text {
    font-size: 0.85rem;
    color: #a89e94;
    line-height: 1.6;
    margin-bottom: 0;
  }

  /* Founder Cards */
  .founder-card {
    background: #14110f;
    border: 1px solid rgba(201, 162, 75, 0.15);
    border-radius: 10px;
    padding: 1.8rem 1.2rem;
    box-shadow: 0 8px 20px rgba(0,0,0,0.5);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    height: 100%;
  }
  
  .founder-card:hover {
    border-color: var(--gold);
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(201, 162, 75, 0.2);
  }
  
  .founder-avatar-wrap {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: rgba(201, 162, 75, 0.05);
    border: 2px dashed rgba(201, 162, 75, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    position: relative;
    transition: all 0.3s ease;
  }
  
  .founder-card:hover .founder-avatar-wrap {
    border-style: solid;
    border-color: var(--gold);
    background: rgba(201, 162, 75, 0.12);
    transform: scale(1.05);
  }
  
  .founder-name {
    font-family: var(--font-label);
    font-size: 1.15rem;
    color: var(--gold-light);
    margin-bottom: 0.3rem;
    letter-spacing: 0.05em;
  }
  
  .founder-role {
    font-family: var(--font-display);
    font-size: 0.8rem;
    color: #8a8175;
    text-transform: uppercase;
    letter-spacing: 0.1em;
  }

  /* Quote banner */
  .brand-story-quote-banner {
    background: linear-gradient(180deg, #100c0a 0%, #080605 100%);
    border-top: 1px solid rgba(201, 162, 75, 0.15);
    border-bottom: 1px solid rgba(201, 162, 75, 0.15);
    position: relative;
  }
  
  .quote-text {
    font-family: var(--font-display);
    font-size: clamp(1.3rem, 3.5vw, 2rem);
    font-weight: 400;
    color: var(--gold);
    line-height: 1.4;
    font-style: italic;
  }
  
  .quote-sub {
    font-size: 0.9rem;
    color: #a89e94;
    line-height: 1.7;
    max-width: 650px;
    margin: 0 auto;
  }
  
  .btn-outline-gold {
    border: 1px solid var(--gold);
    color: var(--gold);
    font-family: var(--font-label);
    font-size: 0.7rem;
    letter-spacing: 0.12em;
    padding: 0.75rem 1.6rem;
    border-radius: 6px;
    background: transparent;
    transition: all 0.3s ease;
  }
  
  .btn-outline-gold:hover {
    background: var(--gold);
    color: #000;
    box-shadow: 0 4px 15px rgba(201, 162, 75, 0.3);
  }
</style>
@endpush

@section('content')
<div class="plp-page">

  <!-- Breadcrumb -->
  <div class="plp-breadcrumb">
    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
    <span class="plp-bc-sep">/</span>
    <span>Brand Story</span>
  </div>

  <!-- Hero Split -->
  <div class="dark-split-hero reverse">
    <div class="dark-split-container">
      <div class="dark-split-content">
        <span class="dark-split-label text-gold"><i class="fa-solid fa-sparkles me-1"></i> THE DREAM &amp; RESILIENCE</span>
        <h1 class="dark-split-title">RANISAHAB  <Br> तीन दोस्तों के सपने की कहानी</h1>
        <p class="dark-split-text" style="font-size:1.15rem; color:var(--gold); font-style:italic; line-height: 1.6;">
          "हर सफल कहानी की शुरुआत सफलता से नहीं होती। कुछ कहानियाँ एक ऐसे लड़के से शुरू होती हैं, जिसे लोग देखकर कहते हैं— 'ये जिंदगी में क्या करेगा?'"
        </p>
        <p class="dark-split-text">
          नवीन नवरंगे, गजेंद्र मारकंडे और ओंकार बंजारे — तीन दोस्त जिन्होंने कभी हार न मानने का वादा किया और हर असफलता को अपनी सीढ़ी बनाया। यह कहानी है उनकी मेहनत, अडिग दोस्ती और RANISAHAB ब्रांड के उदय की।
        </p>
      </div>
      <div class="dark-split-img-wrap">
        <div class="dark-split-img">
          <img src="{{ asset('images/about_heritage.png') }}" alt="RANISAHAB Heritage & Dreams">
        </div>
      </div>
    </div>
  </div>

  <!-- Main Timeline Journey -->
  <div class="dark-section-title mt-4">
    <span class="plp-deco-line" style="max-width:80px;"></span>
    <span class="dark-section-label">THE JOURNEY • यात्रा</span>
    <span class="plp-deco-line" style="max-width:80px;"></span>
  </div>

  <div class="luxury-timeline">
    
    <!-- Item 1 -->
    <div class="timeline-item">
      <div class="timeline-badge"><i class="fa-solid fa-graduation-cap"></i></div>
      <div class="timeline-panel">
        <div class="timeline-content">
          <span class="timeline-year">The Detour</span>
          <h3 class="timeline-title">एक अनपेक्षित मोड़ और शुरुआती संघर्ष</h3>
          <p class="timeline-text">
            Naveen Navrange ने कक्षा 1 से 9 तक हमेशा प्रथम स्थान हासिल किया। लेकिन 10वीं में एक ऐसी गलती हुई जिसने उसकी जिंदगी की दिशा बदल दी—वह 10वीं की परीक्षा ही नहीं दे पाया और फेल हो गया। लेकिन शायद जिंदगी ने उसे रोकने के लिए नहीं, एक अलग रास्ते पर भेजने के लिए यह मोड़ दिया था।
          </p>
        </div>
      </div>
    </div>

    <!-- Item 2 -->
    <div class="timeline-item inverted">
      <div class="timeline-badge"><i class="fa-solid fa-chart-line"></i></div>
      <div class="timeline-panel">
        <div class="timeline-content">
          <span class="timeline-year">Early Hustle</span>
          <h3 class="timeline-title">टेलीग्राम, नेटवर्क मार्केटिंग और ट्रेडिंग</h3>
          <p class="timeline-text">
            अगले ही साल उसने Telegram के जरिए कमाई शुरू की। फिर करीब 2 साल Network Marketing की। पूरी मेहनत की, लेकिन सफलता नहीं मिली। फिर Trading में हाथ आजमाया। कई बार शुरुआत की, कई बार उम्मीद बनी और कई बार सब कुछ टूटता हुआ भी देखा।
          </p>
        </div>
      </div>
    </div>

    <!-- Item 3 -->
    <div class="timeline-item">
      <div class="timeline-badge"><i class="fa-solid fa-users"></i></div>
      <div class="timeline-panel">
        <div class="timeline-content">
          <span class="timeline-year">Friendship</span>
          <h3 class="timeline-title">अटूट दोस्ती का सहारा</h3>
          <p class="timeline-text">
            नवीन के साथ हमेशा दो दोस्त खड़े रहे—Gajendra Markande और Omkar Banjare। नवीन कुछ करने की सोचता, तो ये दोनों कहते— <strong>“करते हैं।”</strong> वे कभी पीछे नहीं हटे, कभी “नहीं” नहीं कहा। तीनों ने हमेशा साथ चलना चुना।
          </p>
        </div>
      </div>
    </div>

    <!-- Item 4 -->
    <div class="timeline-item inverted">
      <div class="timeline-badge"><i class="fa-solid fa-briefcase"></i></div>
      <div class="timeline-panel">
        <div class="timeline-content">
          <span class="timeline-year">Failed Startups</span>
          <h3 class="timeline-title">Lyrics और Mout Headphone</h3>
          <p class="timeline-text">
            तीनों ने पहला Startup शुरू किया—<strong>Lyrics</strong>, एक clothing business। लेकिन वह भी सफल नहीं हुआ। फिर आया <strong>Mout Headphone</strong>, लेकिन वह भी सफल नहीं हुआ। एक के बाद एक असफलताएँ आती रहीं, लेकिन इन तीनों ने एक चीज़ नहीं छोड़ी — एक-दूसरे का साथ।
          </p>
        </div>
      </div>
    </div>

    <!-- Item 5 -->
    <div class="timeline-item">
      <div class="timeline-badge"><i class="fa-solid fa-book-open"></i></div>
      <div class="timeline-panel">
        <div class="timeline-content">
          <span class="timeline-year">Preparation</span>
          <h3 class="timeline-title">आत्म-विकास और तैयारी</h3>
          <p class="timeline-text">
            फिर एक दिन उन्होंने तय किया कि अब सिर्फ business शुरू नहीं करना है, पहले खुद को तैयार करना है। लगभग एक साल तक उन्होंने अपने दूसरे कामों से दूरी बनाई और books, knowledge, business और self-development पर ध्यान दिया। उन्होंने सीखा कि पैसा कमाने से पहले सोच को बड़ा करना पड़ता है। Confidence खरीदा नहीं जाता, बनाया जाता है।
          </p>
        </div>
      </div>
    </div>

    <!-- Item 6 -->
    <div class="timeline-item inverted">
      <div class="timeline-badge"><i class="fa-solid fa-desktop"></i></div>
      <div class="timeline-panel">
        <div class="timeline-content">
          <span class="timeline-year">First Step</span>
          <h3 class="timeline-title">एक कंप्यूटर और बड़े सपने</h3>
          <p class="timeline-text">
            तीनों ने अपनी-अपनी बचत से एक-एक पैसा जोड़कर एक computer खरीदा। किसी बड़े office या investor के पैसे से नहीं, बल्कि तीन दोस्तों के छोटे-छोटे योगदान से एक बड़ा सपना शुरू हुआ। उन्होंने खुद videos बनाईं, खुद सीखा और खुद अपना confidence बनाया।
          </p>
        </div>
      </div>
    </div>

    <!-- Item 7 -->
    <div class="timeline-item">
      <div class="timeline-badge"><i class="fa-solid fa-crown"></i></div>
      <div class="timeline-panel">
        <div class="timeline-content">
          <span class="timeline-year">The Launch</span>
          <h3 class="timeline-title">RANISAHAB का उदय</h3>
          <p class="timeline-text">
            और फिर जन्म हुआ—<strong>RANISAHAB</strong>। एक ऐसा Women’s Fashion Brand, जिसे सिर्फ कपड़ों का business नहीं बनाना था। यह उन तीन दोस्तों की पहचान बनने वाला था, जिन्होंने कई बार असफल होकर भी कहना नहीं छोड़ा— <strong>“एक बार और कोशिश करेंगे।”</strong>
          </p>
        </div>
      </div>
    </div>

  </div>

  <!-- Founders Section -->
  <div class="dark-section-title mt-4">
    <span class="plp-deco-line" style="max-width:80px;"></span>
    <span class="dark-section-label">FOUNDERS &amp; CO-FOUNDERS</span>
    <span class="plp-deco-line" style="max-width:80px;"></span>
  </div>

  <div class="container mb-4">
    <div class="row justify-content-center g-4">
      
      <!-- Naveen -->
      <div class="col-md-4 col-sm-6">
        <div class="founder-card text-center">
          <div class="founder-avatar-wrap">
            <i class="fa-solid fa-user-tie text-gold" style="font-size: 2.2rem;"></i>
          </div>
          <h3 class="founder-name">Naveen Navrange</h3>
          <span class="founder-role">Founder</span>
        </div>
      </div>

      <!-- Gajendra -->
      <div class="col-md-4 col-sm-6">
        <div class="founder-card text-center">
          <div class="founder-avatar-wrap">
            <i class="fa-solid fa-user-tie text-gold" style="font-size: 2.2rem;"></i>
          </div>
          <h3 class="founder-name">Gajendra Markande</h3>
          <span class="founder-role">Co-Founder</span>
        </div>
      </div>

      <!-- Omkar -->
      <div class="col-md-4 col-sm-6">
        <div class="founder-card text-center">
          <div class="founder-avatar-wrap">
            <i class="fa-solid fa-user-tie text-gold" style="font-size: 2.2rem;"></i>
          </div>
          <h3 class="founder-name">Omkar Banjare</h3>
          <span class="founder-role">Co-Founder</span>
        </div>
      </div>

    </div>
  </div>

  <!-- Closing Banner -->
  <div class="brand-story-quote-banner text-center py-4 my-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <i class="fa-solid fa-quote-left text-gold mb-3" style="font-size: 2.5rem; opacity:0.6;"></i>
          <h2 class="quote-text mb-4">“तीन दोस्तों ने… जिन्होंने हार मानने से इंकार कर दिया।”</h2>
          <p class="quote-sub mb-4">
            आज तीनों अभी भी सीख रहे हैं। तीनों अभी भी मेहनत कर रहे हैं। तीनों अभी भी अपने सपने को बड़ा बनाने में लगे हैं। क्योंकि RANISAHAB की कहानी अभी खत्म नहीं हुई है। असल कहानी तो अब शुरू हुई है।
          </p>
          <a href="{{ route('sarees') }}" class="btn btn-outline-gold px-4 py-2"><i class="fa-solid fa-bag-shopping me-2"></i>EXPLORE OUR COLLECTION</a>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
