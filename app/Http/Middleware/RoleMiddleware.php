<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        // Cek role berdasarkan struktur database kamu
        switch ($role) {
            case 'admin':
                if ($user->nis === null && $user->nip === null) {
                    return $next($request);
                }
                break;

            case 'guru':
                if ($user->nip !== null) {
                    return $next($request);
                }
                break;

            case 'siswa':
                if ($user->nis !== null) {
                    return $next($request);
                }
                break;
        }

        return abort(403, 'Akses ditolak.');
    }
}
