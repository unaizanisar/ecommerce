<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckPermission
{
    public function handle($request, Closure $next, ...$permissions)
    {
        if (!Auth::check() || !Auth::user()->can($permissions)) {
            return redirect('/home')->with('error', 'You do not have the necessary permissions to access this resource.');
        }

        return $next($request);
    }
}

