<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    private function aturan(?Pelanggan $pelanggan = null): array
    {
        $id = $pelanggan?->id;
        return [
            'nama'         => 'required|string|max:100',
            'email'        => ['required', 'email', 'max:100', Rule::unique('pelanggan', 'email')->ignore($id)],
            'telepon'      => 'required|string|max:20',
            'alamat'       => 'nullable|string',
            'level_member' => ['required', Rule::in(['Basic', 'Gold', 'VIP'])],
        ];
    }

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $data = Pelanggan::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('nama', 'like', "%$q%")
                      ->orWhere('email', 'like', "%$q%")
                      ->orWhere('telepon', 'like', "%$q%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('pelanggan.index', ['data' => $data, 'q' => $q]);
    }

    public function create()
    {
        return view('pelanggan.create', ['pelanggan' => new Pelanggan()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->aturan());
        Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', ['pelanggan' => $pelanggan]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate($this->aturan($pelanggan));
        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        try {
            $pelanggan->delete();
            return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->route('pelanggan.index')->with('error', 'Data pelanggan gagal dihapus.');
        }
    }
}
