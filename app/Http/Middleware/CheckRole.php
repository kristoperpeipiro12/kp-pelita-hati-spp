<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user() && $request->user()->role !== $role) {
            // Jika peran pengguna tidak sesuai, Anda dapat mengembalikan respons larangan atau melakukan tindakan lain sesuai kebutuhan aplikasi Anda.
            // return response('Unauthorized.', 401);
            return redirect()->route('login');

        }

        return $next($request);
    }
}