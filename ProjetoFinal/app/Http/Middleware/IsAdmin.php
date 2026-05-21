<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $user  = User::where('api_token', $token)->first();

        if (!$user || !$user->is_admin) {
            return response()->json(['message' => 'Acesso negado.'], 403);
        }

        return $next($request);
    }
}
