@extends('layouts.admin')

@section('title', 'Measurement Sheet Detail')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto mb-4">
        <!-- Action bar -->
        <div class="d-flex justify-content-between align-items-center mb-3 no-print">
            <a href="{{ route('admin.measurements.index') }}" class="btn btn-light rounded-pill"><i class="fas fa-arrow-left me-2"></i> Back</a>
            <button onclick="window.print();" class="btn btn-warning rounded-pill px-4"><i class="fas fa-print me-2"></i> Print for Studio/Karigar</button>
        </div>

        <!-- Sizing Sheet Card -->
        <div class="card shadow border border-warning border-opacity-25" id="printable-sheet">
            <div class="card-body p-5">
                <div class="text-center mb-5">
                    <h3 class="fw-bold text-warning uppercase letter-spacing-2 mb-1">RANI SAHAB BOUTIQUE</h3>
                    <h6 class="text-muted small text-uppercase">Couture Sizing & Fitting Specs Sheet</h6>
                    <hr class="w-25 mx-auto border-warning">
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-6">
                        <span class="text-uppercase text-muted small d-block">Client Name</span>
                        <span class="fs-5 fw-bold text-white">{{ $measurement->customer->first_name }} {{ $measurement->customer->last_name }}</span>
                    </div>
                    <div class="col-6 text-end">
                        <span class="text-uppercase text-muted small d-block">Fitting Label</span>
                        <span class="fs-5 fw-bold text-warning">{{ $measurement->title }}</span>
                    </div>
                    <div class="col-6">
                        <span class="text-uppercase text-muted small d-block">Client Contact</span>
                        <span class="text-white">{{ $measurement->customer->phone }} | {{ $measurement->customer->email }}</span>
                    </div>
                    <div class="col-6 text-end">
                        <span class="text-uppercase text-muted small d-block">Logged On</span>
                        <span class="text-white">{{ $measurement->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>

                <h5 class="fw-bold text-warning text-uppercase mb-4 border-bottom pb-2">Measurement Matrix (Inches)</h5>
                
                <div class="row row-cols-2 row-cols-md-3 g-4 mb-5 text-center">
                    <div class="col">
                        <div class="p-3 bg-dark bg-opacity-20 rounded-3 border">
                            <span class="d-block text-muted small text-uppercase">Bust</span>
                            <span class="fs-4 fw-bold text-white">{{ $measurement->bust ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-dark bg-opacity-20 rounded-3 border">
                            <span class="d-block text-muted small text-uppercase">Waist</span>
                            <span class="fs-4 fw-bold text-white">{{ $measurement->waist ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-dark bg-opacity-20 rounded-3 border">
                            <span class="d-block text-muted small text-uppercase">Hips</span>
                            <span class="fs-4 fw-bold text-white">{{ $measurement->hips ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-dark bg-opacity-20 rounded-3 border">
                            <span class="d-block text-muted small text-uppercase">Shoulder</span>
                            <span class="fs-4 fw-bold text-white">{{ $measurement->shoulder ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-dark bg-opacity-20 rounded-3 border">
                            <span class="d-block text-muted small text-uppercase">Chest</span>
                            <span class="fs-4 fw-bold text-white">{{ $measurement->chest ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-dark bg-opacity-20 rounded-3 border">
                            <span class="d-block text-muted small text-uppercase">Sleeve L</span>
                            <span class="fs-4 fw-bold text-white">{{ $measurement->sleeve_length ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-dark bg-opacity-20 rounded-3 border">
                            <span class="d-block text-muted small text-uppercase">Lehenga L</span>
                            <span class="fs-4 fw-bold text-white">{{ $measurement->lehenga_length ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 bg-dark bg-opacity-20 rounded-3 border">
                            <span class="d-block text-muted small text-uppercase">Blouse L</span>
                            <span class="fs-4 fw-bold text-white">{{ $measurement->blouse_length ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                @if($measurement->notes)
                    <h5 class="fw-bold text-warning text-uppercase mb-3 border-bottom pb-2">Stitching Notes & Customizations</h5>
                    <div class="p-4 bg-dark bg-opacity-10 rounded-3 border border-secondary text-muted">
                        {{ $measurement->notes }}
                    </div>
                @endif

                <div class="mt-5 pt-5 text-center text-muted small signature-line" style="display:none;">
                    <div class="row">
                        <div class="col-6">
                            <hr class="w-50 mx-auto">
                            <span>Karigar / Master Tailor Signature</span>
                        </div>
                        <div class="col-6">
                            <hr class="w-50 mx-auto">
                            <span>Boutique Manager Signature</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printable-sheet, #printable-sheet * {
        visibility: visible;
    }
    #printable-sheet {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        border: none !important;
        box-shadow: none !important;
        color: #000 !important;
        background: #fff !important;
    }
    .no-print {
        display: none !important;
    }
    .bg-dark {
        background: transparent !important;
        color: #000 !important;
    }
    .border {
        border: 1px solid #ddd !important;
    }
    .text-white {
        color: #000 !important;
    }
    .text-warning {
        color: #8b6b3e !important;
    }
    .signature-line {
        display: block !important;
    }
}
</style>
@endsection
