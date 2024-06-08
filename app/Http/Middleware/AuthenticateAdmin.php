<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;


class AuthenticateAdmin
{
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard('admin-api')->check()) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
