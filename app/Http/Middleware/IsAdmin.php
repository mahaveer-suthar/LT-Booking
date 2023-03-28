<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
       if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == 2) {
            return redirect()->route('teacher.home');
        }

        if (Auth::user()->role == 3) {
            return redirect()->route('student.home');
        }
        if (Auth::user()->role == 4) {
            return redirect()->route('user.home');
        }
        if (Auth::user()->role == 1) {
            return $next($request);
        } else {
            return back(); // Redirecting same dashboard when user try to access another dashboard by typing in the URL
        }
    }
}

