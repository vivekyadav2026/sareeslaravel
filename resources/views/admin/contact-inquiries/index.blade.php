@extends('layouts.admin')

@section('title', 'Contact Inquiries & Messages')

@section('content')
<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-gold mb-1"><i class="fas fa-envelope-open-text me-2"></i>Contact Inquiries &amp; Messages</h3>
            <p class="text-muted small mb-0">View and respond to inquiries submitted through the website Contact Us page.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-dark text-success border-success" role="alert">
            <i class="fas fa-check-circle me-2 text-gold"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card bg-dark text-white border border-secondary shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="table-black text-gold border-bottom border-warning border-opacity-25">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Client Name</th>
                            <th>Contact Info</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Received At</th>
                            <th class="pe-3 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr>
                                <td class="ps-3 fw-bold text-gold">#{{ $inquiry->id }}</td>
                                <td class="fw-bold text-light">{{ $inquiry->name }}</td>
                                <td>
                                    <div><i class="fas fa-envelope text-gold me-1 small"></i> <a href="mailto:{{ $inquiry->email }}" class="text-info text-decoration-none">{{ $inquiry->email }}</a></div>
                                    @if($inquiry->phone)
                                        <div><i class="fas fa-phone text-gold me-1 small"></i> <a href="tel:{{ $inquiry->phone }}" class="text-light text-decoration-none">{{ $inquiry->phone }}</a></div>
                                    @endif
                                </td>
                                <td><span class="badge bg-secondary text-white">{{ $inquiry->subject }}</span></td>
                                <td>
                                    <div class="small text-light" style="max-width: 320px; white-space: normal;">
                                        {{ $inquiry->message }}
                                    </div>
                                </td>
                                <td>
                                    @if($inquiry->status === 'unread')
                                        <span class="badge bg-warning text-dark">Unread</span>
                                    @elseif($inquiry->status === 'read')
                                        <span class="badge bg-info text-dark">Read</span>
                                    @else
                                        <span class="badge bg-success text-white">Replied</span>
                                    @endif
                                </td>
                                <td class="small text-muted">{{ $inquiry->created_at ? $inquiry->created_at->format('M d, Y H:i') : 'N/A' }}</td>
                                <td class="pe-3 text-end">
                                    <form action="{{ route('admin.contact-inquiries.update-status', $inquiry->id) }}" method="POST" class="d-inline me-1">
                                        @csrf
                                        <input type="hidden" name="status" value="{{ $inquiry->status === 'unread' ? 'read' : ($inquiry->status === 'read' ? 'replied' : 'read') }}">
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Toggle Status">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.contact-inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Inquiry">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 text-secondary"></i>
                                    <p class="mb-0">No contact inquiries received yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($inquiries->hasPages())
            <div class="card-footer bg-transparent border-top border-secondary p-3">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
