<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Subscription;

class VerifySubscriptionApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('x-api-key');
    
        $subscription = Subscription::where('api_key', $apiKey)->first();
    
        if (!$subscription || $subscription->expires_at < now()) {
            // Log the unauthorized access attempt
            \Log::warning('Unauthorized access attempt with API key: ' . $apiKey);
    
            return response()->json(['error' => 'Unauthorized or expired API key'], 401);
        }
    
        return $next($request);
    }
    
}
