<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login'); // Redirect ke halaman login jika belum login
        }

        // Cek apakah role sesuai
        // if (Auth::user()->role !== $role) {
        //     return abort(403, 'Unauthorized'); // Tampilkan error 403 jika tidak memiliki akses
        // }

        return $next($request);
    }
}
