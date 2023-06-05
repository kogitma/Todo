<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // リクエストからのsessionに'user'がない場合
        if (!$request->session()->has('user')) {
            return redirect('login/');
        }

        return $next($request);
    }
}