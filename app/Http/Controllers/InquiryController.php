<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'country' => 'required|string|max:150',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service_type' => 'required|string|max:100',
            'details' => 'required|string|min:15|max:5000',
        ]);

        $validated['ip_address'] = $request->ip();

        Inquiry::create($validated);

        return back()->with('success_inquiry', __('safir.contact.form.success'));
    }
}
