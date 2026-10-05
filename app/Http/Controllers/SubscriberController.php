<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'full_name' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
        ]);

        $subscriber = Subscriber::firstOrCreate(
            ['email' => $validated['email']],
            [
                'full_name' => $validated['full_name'] ?? null,
                'organization' => $validated['organization'] ?? null,
                'locale' => app()->getLocale(),
                'status' => 'active',
            ]
        );

        $message = __('safir.bulletin.success');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return back()->with('success_subscription', $message);
    }
}
