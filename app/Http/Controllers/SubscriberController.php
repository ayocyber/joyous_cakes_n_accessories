<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:subscribers,email',],
        ]);

        Subscriber::firstOrCreate(
            ['email' => $validated['email']],
            [
                'is_active' => true,
                'subscribed_at' => now(),
            ]
        );

        return back()->with('success', 'Thank you for subscribing!');
    }
}
