<?php

namespace App\Http\Controllers;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mengambil semua data lapangan dari database
        $lapangans = Lapangan::all();

        // Mengirim data tersebut ke file view bernama 'lapangan.index'
        return view('lapangan.index', compact('lapangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lapangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan' => 'required',
            'jenis' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);
        \App\Models\Lapangan::create($request->except('_token'));

        return redirect('/lapangan')->with('success', 'Data lapangan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lapangan = \App\Models\Lapangan::findOrFail($id);
        return view('lapangan.edit', compact('lapangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lapangan' => 'required',
            'jenis' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);
        $lapangan = \App\Models\Lapangan::findOrFail($id);
        $lapangan->update($request->except(['_token', '_method']));

        return redirect()->route('lapangan.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lapangan = \App\Models\Lapangan::findOrFail($id);
        $lapangan->delete();

        return redirect()->route('lapangan.index');
    }
}
