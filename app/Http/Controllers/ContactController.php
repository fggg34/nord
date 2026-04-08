<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'in:Quote,Meeting,general,Partnership,Careers'],
            'message' => ['nullable', 'string', 'max:10000'],
        ]);

        Log::info('Contact form submission', $validated);

        return redirect()
            ->route('contact-us')
            ->withFragment('contacts')
            ->with('status', 'Thank you! We will get back to you within 1–3 business days.');
    }
}
