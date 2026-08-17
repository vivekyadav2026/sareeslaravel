@extends('layouts.app')

@section('title', 'Exclusive Design Certificate — RANISAHAB Couture')

@section('content')
<div class="certificate-page-wrap py-5 text-ivory" style="background-color: #080706; min-height: 90vh;">
    <div class="container text-center" style="max-width: 800px;">
        
        <!-- Controls Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <a href="{{ route('customer.orders') }}" class="btn btn-outline-gold btn-sm px-3 font-label text-gold">
                <i class="fa-solid fa-arrow-left me-1"></i> BACK TO ORDERS
            </a>
            <button onclick="window.print()" class="btn btn-gold btn-sm px-4 font-label fw-bold text-dark">
                <i class="fa-solid fa-print me-1"></i> PRINT / SAVE AS PDF
            </button>
        </div>

        <!-- Premium Certificate Frame -->
        <div class="certificate-inner-frame p-5 text-center relative" id="printableCertificate">
            <!-- Ornate Corner Decos -->
            <div class="cert-corner top-left"></div>
            <div class="cert-corner top-right"></div>
            <div class="cert-corner bottom-left"></div>
            <div class="cert-corner bottom-right"></div>

            <div class="mb-4">
                <i class="fa-solid fa-crown text-gold fs-1 display-4 mb-2"></i>
                <h1 class="font-display text-gold mb-1" style="font-size: 2.2rem; letter-spacing: 0.15em; font-weight: 400;">RANISAHAB</h1>
                <p class="text-white-50 font-label tracking-wide mb-0" style="font-size: 0.75rem; letter-spacing: 0.4em; text-transform: uppercase;">Luxury Bridal Couture House</p>
            </div>

            <div class="my-4">
                <h2 class="font-display text-gold-light" style="font-size: 1.6rem; letter-spacing: 0.1em; font-weight: 300;">CERTIFICATE OF AUTHENTICITY &amp; EXCLUSIVITY</h2>
                <div class="cert-divider mx-auto my-3"></div>
            </div>

            <div class="cert-body-content text-white-50 mx-auto" style="max-width: 620px; font-size: 0.92rem; line-height: 1.8;">
                <p class="mb-3">
                    This document officially certifies that the custom-curated bridal outfit and accessories ordered under 
                    Royal Order <strong class="text-gold">#{{ $order->order_number }}</strong> are authentic, one-of-a-kind creations designed and handloom-woven by the 
                    certified master craftspeople of <strong class="text-white">RANISAHAB</strong>.
                </p>
                <p class="mb-4 text-white-50">
                    Each design blueprint used in this creation has been locked in our archive and is guaranteed **never to be recreated or duplicated** 
                    for anyone else in the world, maintaining your unique couture exclusivity.
                </p>

                <!-- Dynamic Item details -->
                <div class="table-responsive p-3 rounded mb-4" style="background: rgba(255,255,255,0.015); border: 1px solid rgba(201, 162, 75, 0.15);">
                    <table class="table table-borderless text-white-50 m-0 small" style="text-align: left;">
                        <tbody>
                            <tr>
                                <td style="width: 30%;" class="text-gold fw-semibold">CERTIFICATE ID:</td>
                                <td class="text-white">RS-CERT-2026-{{ 100000 + $order->id }}</td>
                            </tr>
                            <tr>
                                <td class="text-gold fw-semibold">PATRON:</td>
                                <td class="text-white text-capitalize">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                            </tr>
                            <tr>
                                <td class="text-gold fw-semibold">ITEMS CERTIFIED:</td>
                                <td class="text-white">
                                    @foreach($order->items as $item)
                                        {{ $item->product_name }}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gold fw-semibold">SPECIFICATIONS:</td>
                                <td class="text-white">100% Pure Silk / Handloom Zari Threads. Authentic Craftsmanship Certified.</td>
                            </tr>
                            <tr>
                                <td class="text-gold fw-semibold">EXCLUSIVITY STATUS:</td>
                                <td class="text-success fw-bold"><i class="fa-solid fa-lock me-1"></i> LOCKED &amp; RETIRED FROM ATELIER</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Signatures -->
                <div class="row mt-5 pt-4">
                    <div class="col-6 text-center">
                        <div class="cert-signature-line mb-2 mx-auto" style="width: 140px; height: 1px; background: rgba(255,255,255,0.25);"></div>
                        <span class="small font-label d-block text-gold-light" style="font-size:0.72rem; letter-spacing:0.05em;">MASTER WEAVER GUILD</span>
                        <span class="small text-muted" style="font-size:0.65rem;">Varanasi &amp; Kanchipuram Artisans</span>
                    </div>
                    <div class="col-6 text-center">
                        <div class="cert-signature-line mb-2 mx-auto" style="width: 140px; height: 1px; background: rgba(255,255,255,0.25);"></div>
                        <span class="small font-label d-block text-gold-light" style="font-size:0.72rem; letter-spacing:0.05em;">RANISAHAB COUTURE</span>
                        <span class="small text-muted" style="font-size:0.65rem;">Official Registrar Stamp</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    /* Certificate Design Styles */
    .certificate-inner-frame {
        background: linear-gradient(135deg, #100d0a 0%, #050403 100%);
        border: 2px solid var(--gold);
        border-radius: 12px;
        position: relative;
        box-shadow: 0 25px 60px rgba(0,0,0,0.85);
    }
    
    .cert-divider {
        width: 120px;
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, var(--gold) 50%, transparent 100%);
    }

    /* Corner Decos */
    .cert-corner {
        position: absolute;
        width: 30px;
        height: 30px;
        border: 2px solid var(--gold);
        opacity: 0.7;
    }
    .cert-corner.top-left {
        top: 15px;
        left: 15px;
        border-right: none;
        border-bottom: none;
    }
    .cert-corner.top-right {
        top: 15px;
        right: 15px;
        border-left: none;
        border-bottom: none;
    }
    .cert-corner.bottom-left {
        bottom: 15px;
        left: 15px;
        border-right: none;
        border-top: none;
    }
    .cert-corner.bottom-right {
        bottom: 15px;
        right: 15px;
        border-left: none;
        border-top: none;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #printableCertificate, #printableCertificate * {
            visibility: visible;
        }
        #printableCertificate {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: 2px solid #000;
            background: #fff !important;
            color: #000 !important;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endpush
