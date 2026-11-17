<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlatController extends Controller
{
    private function aturan(?Alat $alat = null): array
    {
        $id = $alat?->id;
        return [
            'kode'       => ['required', 'string', 'max:20', Rule::unique('alat', 'kode')->ignore($id)],
            'nama'       => 'required|string|max:100',
            'kategori'   => 'required|string|max:50',
            'kondisi'    => ['required', Rule::in(['Baik', 'Cukup', 'Rusak'])],
            'stok'       => 'required|integer|min:0',
            'tarif_sewa' => 'required|numeric|min:0|max:99999999.99',
        ];
    }

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $data = Alat::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('kode', 'like', "%$q%")
                      ->orWhere('nama', 'like', "%$q%")
                      ->orWhere('kategori', 'like', "%$q%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('alat.index', ['data' => $data, 'q' => $q]);
    }

    public function create()
    {
        return view('alat.create', ['alat' => new Alat()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->aturan());
        Alat::create($validated);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil ditambahkan.');
    }

    public function edit(Alat $alat)
    {
        return view('alat.edit', ['alat' => $alat]);
    }

    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate($this->aturan($alat));
        $alat->update($validated);

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil diperbarui.');
    }

    public function destroy(Alat $alat)
    {
        try {
            $alat->delete();
            return redirect()->route('alat.index')->with('success', 'Data alat berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->route('alat.index')->with('error', 'Data alat gagal dihapus.');
        }
    }
}
