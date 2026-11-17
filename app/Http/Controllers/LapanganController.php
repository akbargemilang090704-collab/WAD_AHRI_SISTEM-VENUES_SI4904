<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LapanganController extends Controller
{
    private function aturan(?Lapangan $lapangan = null): array
    {
        $id = $lapangan?->id;
        return [
            'kode'            => ['required', 'string', 'max:20', Rule::unique('lapangan', 'kode')->ignore($id)],
            'nama'            => 'required|string|max:100',
            'jenis_olahraga'  => 'required|string|max:50',
            'jenis_permukaan' => 'required|string|max:50',
            'ukuran'          => 'required|string|max:50',
            'status_fisik'    => ['required', Rule::in(['Baik', 'Perlu Perawatan', 'Rusak'])],
        ];
    }

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $data = Lapangan::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('kode', 'like', "%$q%")
                      ->orWhere('nama', 'like', "%$q%")
                      ->orWhere('jenis_olahraga', 'like', "%$q%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('lapangan.index', ['data' => $data, 'q' => $q]);
    }

    public function create()
    {
        return view('lapangan.create', ['lapangan' => new Lapangan()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->aturan());
        Lapangan::create($validated);

        return redirect()->route('lapangan.index')->with('success', 'Data lapangan berhasil ditambahkan.');
    }

    public function edit(Lapangan $lapangan)
    {
        return view('lapangan.edit', ['lapangan' => $lapangan]);
    }

    public function update(Request $request, Lapangan $lapangan)
    {
        $validated = $request->validate($this->aturan($lapangan));
        $lapangan->update($validated);

        return redirect()->route('lapangan.index')->with('success', 'Data lapangan berhasil diperbarui.');
    }

    public function destroy(Lapangan $lapangan)
    {
        try {
            $lapangan->delete();
            return redirect()->route('lapangan.index')->with('success', 'Data lapangan berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->route('lapangan.index')->with('error', 'Data lapangan gagal dihapus.');
        }
    }
}
