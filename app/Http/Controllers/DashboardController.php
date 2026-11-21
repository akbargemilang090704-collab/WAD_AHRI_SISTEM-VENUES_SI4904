<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Instruktur;
use App\Models\Lapangan;
use App\Models\Pelanggan;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {
        return redirect()->route(auth()->user()->isAdmin() ? 'admin.dashboard' : 'user.dashboard');
    }

  
    public function admin()
    {
        $data = [
            'totalAlat'        => Alat::count(),
            'totalStokAlat'    => (int) Alat::sum('stok'),
            'totalLapangan'    => Lapangan::count(),
            'lapanganBaik'     => Lapangan::where('status_fisik', 'Baik')->count(),
            'totalInstruktur'  => Instruktur::count(),
            'instrukturAktif'  => Instruktur::where('status', 'Aktif')->count(),
            'totalPelanggan'   => Pelanggan::count(),
            'totalUser'        => User::count(),
            'levelMember'      => Pelanggan::selectRaw('level_member, COUNT(*) as total')
                                    ->groupBy('level_member')->pluck('total', 'level_member'),
            'lapanganTerbaru'  => Lapangan::orderByDesc('id')->limit(5)->get(),
            'pelangganTerbaru' => Pelanggan::orderByDesc('id')->limit(5)->get(),
        ];

        return view('dashboard', $data);
    }


    public function user()
    {
        return view('user.dashboard', [
            'totalLapangan'   => Lapangan::count(),
            'lapanganBaik'    => Lapangan::where('status_fisik', 'Baik')->count(),
            'totalInstruktur' => Instruktur::where('status', 'Aktif')->count(),
            'totalAlat'       => Alat::count(),
            'lapanganTerbaru' => Lapangan::orderByDesc('id')->limit(5)->get(),
        ]);
    }
}
