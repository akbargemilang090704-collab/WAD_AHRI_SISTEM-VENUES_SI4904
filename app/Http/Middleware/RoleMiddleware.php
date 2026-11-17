<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Membatasi akses route berdasarkan kolom `role` pada tabel users.
 *
 * Pemakaian di routes/web.php:
 *   ->middleware('role:admin')        hanya admin
 *   ->middleware('role:user')         hanya user
 *   ->middleware('role:admin,user')   admin ATAU user
 */
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Pengaman tambahan: kalau middleware ini dipakai tanpa 'auth', tamu tetap ditolak.
        if (! $user) {
            return redirect()->route('login');
        }

        // Role dibaca dari database pada setiap request, jadi perubahan role langsung berlaku.
        if (! in_array($user->role, $roles, true)) {
            abort(403, 'Anda tidak memiliki hak akses untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
