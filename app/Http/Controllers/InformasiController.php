<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Instruktur;
use App\Models\Lapangan;
use Illuminate\Http\Request;

/**
 * Halaman informasi HANYA-BACA untuk role user.
 * Tidak ada tambah/ubah/hapus. Data pelanggan & pengguna tidak ditampilkan.
 */
class InformasiController extends Controller
{
    private function cari(Request $request): string
    {
        return trim((string) $request->query('q'));
    }

    public function lapangan(Request $request)
    {
        $q = $this->cari($request);

        $data = Lapangan::query()
            ->when($q !== '', fn ($query) => $query->where(function ($w) use ($q) {
                $w->where('kode', 'like', "%$q%")
                  ->orWhere('nama', 'like', "%$q%")
                  ->orWhere('jenis_olahraga', 'like', "%$q%");
            }))
            ->orderBy('nama')->paginate(10)->withQueryString();

        return view('user.lapangan', ['data' => $data, 'q' => $q]);
    }

    public function instruktur(Request $request)
    {
        $q = $this->cari($request);

        $data = Instruktur::query()
            ->when($q !== '', fn ($query) => $query->where(function ($w) use ($q) {
                $w->where('nama', 'like', "%$q%")->orWhere('keahlian', 'like', "%$q%");
            }))
            ->orderBy('nama')->paginate(10)->withQueryString();

        return view('user.instruktur', ['data' => $data, 'q' => $q]);
    }

    public function alat(Request $request)
    {
        $q = $this->cari($request);

        $data = Alat::query()
            ->when($q !== '', fn ($query) => $query->where(function ($w) use ($q) {
                $w->where('kode', 'like', "%$q%")
                  ->orWhere('nama', 'like', "%$q%")
                  ->orWhere('kategori', 'like', "%$q%");
            }))
            ->orderBy('nama')->paginate(10)->withQueryString();

        return view('user.alat', ['data' => $data, 'q' => $q]);
    }
}
