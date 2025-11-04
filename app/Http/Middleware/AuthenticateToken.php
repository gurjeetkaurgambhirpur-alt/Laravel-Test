<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthenticateToken
{
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');
        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rawToken = substr($authHeader, 7);
        $hashed = hash('sha256', $rawToken);

        $record = ApiToken::where('token', $hashed)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::find($record->user_id);
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Attach the user for controllers via request->user()
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}


