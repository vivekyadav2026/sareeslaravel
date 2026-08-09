<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactInquiry;

class ContactInquiryController extends Controller
{
    public function index(Request $request)
    {
        $inquiries = ContactInquiry::orderBy('id', 'desc')->paginate(15);
        return view('admin.contact-inquiries.index', compact('inquiries'));
    }

    public function updateStatus(Request $request, ContactInquiry $inquiry)
    {
        $request->validate(['status' => 'required|in:unread,read,replied']);
        $inquiry->update(['status' => $request->status]);
        return back()->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy(ContactInquiry $inquiry)
    {
        $inquiry->delete();
        return back()->with('success', 'Inquiry deleted successfully.');
    }
}
