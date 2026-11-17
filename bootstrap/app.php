<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias middleware kustom. Dipakai di routes/web.php: ->middleware('role:admin')
        // Alias bawaan (auth, guest, throttle) sudah otomatis tersedia di Laravel 12.
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        // Pengguna yang SUDAH login lalu membuka /login diarahkan ke dashboard.
        // Route 'dashboard' akan meneruskan ke dashboard admin / user sesuai role.
        $middleware->redirectUsersTo(fn () => route('dashboard'));

        // Pengguna yang BELUM login dan membuka halaman terproteksi diarahkan ke login.
        $middleware->redirectGuestsTo(fn () => route('login'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
