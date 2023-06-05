<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;

class AuthLoginCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // リクエストからのsessionに'user'がない場合
        if (!$request->session()->has('user')) {
            return redirect('login/');
        }
        else if ($request->session()->get('user')->auth == 2) {
            return redirect('/');
        }

        return $next($request);
    }
}