<?php

namespace App\Http\Middleware;

use App\Models\ApiIntegration;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IntegrationApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $authorization = $request->header('Authorization');

        if (!$authorization || !str_starts_with($authorization, 'Bearer ')) {
            return response()->json([
                'message' => 'Integration token is required.',
            ], 401);
        }

        $token = trim(substr($authorization, 7));

        if ($token === '') {
            return response()->json([
                'message' => 'Integration token is required.',
            ], 401);
        }

        $tokenHash = hash('sha256', $token);

        $integration = ApiIntegration::where('token_hash', $tokenHash)
            ->where('is_active', true)
            ->first();

        if (!$integration) {
            return response()->json([
                'message' => 'Invalid integration token.',
            ], 401);
        }

        $integration->update([
            'last_used_at' => now(),
        ]);

        // Make integration available to the controller
        $request->attributes->set('integration', $integration);

        return $next($request);
    }
}
