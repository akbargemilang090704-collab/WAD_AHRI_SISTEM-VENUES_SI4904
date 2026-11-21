<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstrukturController extends Controller
{
    private function aturan(?Instruktur $instruktur = null): array
    {
        $id = $instruktur?->id;
        return [
            'nama'       => 'required|string|max:100',
            'no_lisensi' => ['required', 'string', 'max:50', Rule::unique('instruktur', 'no_lisensi')->ignore($id)],
            'keahlian'   => 'required|string|max:50',
            'telepon'    => 'required|string|max:20',
            'status'     => ['required', Rule::in(['Aktif', 'Nonaktif'])],
        ];
    }

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $data = Instruktur::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('nama', 'like', "%$q%")
                      ->orWhere('no_lisensi', 'like', "%$q%")
                      ->orWhere('keahlian', 'like', "%$q%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('instruktur.index', ['data' => $data, 'q' => $q]);
    }

    public function create()
    {
        return view('instruktur.create', ['instruktur' => new Instruktur()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->aturan());
        Instruktur::create($validated);

        return redirect()->route('instruktur.index')->with('success', 'Data instruktur berhasil ditambahkan.');
    }

    public function edit(Instruktur $instruktur)
    {
        return view('instruktur.edit', ['instruktur' => $instruktur]);
    }

    public function update(Request $request, Instruktur $instruktur)
    {
        $validated = $request->validate($this->aturan($instruktur));
        $instruktur->update($validated);

        return redirect()->route('instruktur.index')->with('success', 'Data instruktur berhasil diperbarui.');
    }

    public function destroy(Instruktur $instruktur)
    {
        try {
            $instruktur->delete();
            return redirect()->route('instruktur.index')->with('success', 'Data instruktur berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->route('instruktur.index')->with('error', 'Data instruktur gagal dihapus.');
        }
    }
}
