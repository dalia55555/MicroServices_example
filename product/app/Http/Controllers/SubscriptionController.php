<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    /**
     * Create a new subscription.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        $subscription = Subscription::create([
            'name' => $request->name,
            'email' => $request->email,
            'api_key' => Str::random(32),
            'expires_at' => now()->addYear(), // Set expiration for one month
        ]);

        return response()->json([
            'message' => 'Subscription created successfully.',
            'api_key' => $subscription->api_key,
            'expires_at' => $subscription->expires_at,
        ]);
    }

    /**
     * Renew an existing subscription.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function renew(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        // Renew subscription by updating the expiration date and regenerating the API key if needed
        $subscription->expires_at = now()->addYear();
        $subscription->api_key = Str::random(32); // Generate a new API key

        $subscription->save();

        return response()->json([
            'message' => 'Subscription renewed successfully.',
            'api_key' => $subscription->api_key,
            'expires_at' => $subscription->expires_at,
        ]);
    }

    /**
     * View subscription details.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);

        return response()->json([
            'id' => $subscription->id,
            'name' => $subscription->name,
            'email' => $subscription->email,
            'api_key' => $subscription->api_key,
            'expires_at' => $subscription->expires_at,
        ]);
    }
}
