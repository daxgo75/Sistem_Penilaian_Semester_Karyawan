<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //  Ambil role dari user yang sedang login
        $role = $request->user()->role;

        // Ambil argumen role-role yang diizinkan untuk mengakses route
        $roles = array_slice(func_get_args(), 2);

        // Jika role user tidak termasuk dalam roles maka redirect ke halaman utama
        if (!in_array($role, $roles)) {
            return redirect()->route('dashboard');
        }

        // Jika role user termasuk dalam roles maka lanjutkan request
        return $next($request);
    }
}
