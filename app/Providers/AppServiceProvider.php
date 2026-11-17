<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $this->konfigurasiRateLimiter();
    }

    /**
     * Rate limiter bernama "login", dipakai lewat middleware throttle:login.
     * - 5 percobaan per menit untuk kombinasi username + IP
     * - 20 percobaan per menit untuk satu IP (mencegah tebak banyak username)
     * Saat batas tercapai: HTTP 429 + halaman login dengan pesan dan hitung mundur.
     */
    protected function konfigurasiRateLimiter(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $username = Str::lower((string) $request->input('username'));

            $responTerlaluBanyak = function (Request $request, array $headers) {
                $detik = max(1, (int) ($headers['Retry-After'] ?? 60));

                return response()->view('auth.login', [
                    'throttleMessage' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$detik} detik.",
                    'retryAfter'      => $detik,
                    'username'        => (string) $request->input('username'),
                ], 429, $headers);
            };

            return [
                Limit::perMinute(5)->by($username . '|' . $request->ip())->response($responTerlaluBanyak),
                Limit::perMinute(20)->by($request->ip())->response($responTerlaluBanyak),
            ];
        });
    }
}
