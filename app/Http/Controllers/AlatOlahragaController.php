<?php

namespace App\Http\Controllers;

use App\Models\AlatOlahraga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AlatOlahragaController extends Controller
{
    private const KONDISI = ['Layak Pakai', 'Rusak'];

    public function index(): View
    {
        return view('alat-olahraga.index', [
            'alatOlahragas' => AlatOlahraga::query()->latest()->get(),
            'kondisis' => self::KONDISI,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        AlatOlahraga::create($this->validatedData($request));

        return redirect()->route('alat-olahraga.index')->with('status', 'Alat olahraga berhasil ditambahkan.');
    }

    public function update(Request $request, AlatOlahraga $alatOlahraga): RedirectResponse
    {
        $alatOlahraga->update($this->validatedData($request));

        return redirect()->route('alat-olahraga.index')->with('status', 'Data alat olahraga berhasil diperbarui.');
    }

    public function destroy(AlatOlahraga $alatOlahraga): RedirectResponse
    {
        $alatOlahraga->delete();

        return redirect()->route('alat-olahraga.index')->with('status', 'Alat olahraga berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama_alat' => ['required', 'string', 'max:255'],
            'kondisi' => ['required', 'string', Rule::in(self::KONDISI)],
            'tarif' => ['required', 'integer', 'min:0'],
        ]);
    }
}
