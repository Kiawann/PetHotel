<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataHewan;
use App\Models\DataPemilik;
use App\Models\KategoriHewan;
use Illuminate\Http\Request;

class DataHewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_hewan = DataHewan::with(['pemilik', 'kategori'])->get();
        return view('admin.data-hewan', compact('data_hewan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemilik = DataPemilik::all();
        $kategori = KategoriHewan::all();

        // Kirim data ke view
        return view('admin.data-hewan-create', compact('pemilik', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori_hewan' => 'required|string|unique:data_hewan,id_kategori_hewan',
            'id_data_pemilik' => 'required|string',
            'nama_hewan' => 'required|string',
            'umur' => 'required|integer',
            'berat_badan' => 'required|integer',
            'warna' => 'required|string',
            'ras_hewan' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('hewan_foto', 'public');
        }

        DataHewan::create($validated);

        return redirect()->route('data_hewan.index')->with('success', 'Data Hewan berhasil ditambahkan.');
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
        $data_hewan = DataHewan::findOrFail($id);
        return view('data_hewan.edit', compact('data_hewan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data_hewan = DataHewan::findOrFail($id);

        $validated = $request->validate([
            'id_data_pemilik' => 'required|string',
            'nama_hewan' => 'required|string',
            'umur' => 'required|integer',
            'berat_badan' => 'required|integer',
            'warna' => 'required|string',
            'ras_hewan' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('hewan_foto', 'public');
        }

        $data_hewan->update($validated);

        return redirect()->route('data_hewan.index')->with('success', 'Data Hewan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_hewan = DataHewan::findOrFail($id);
        $data_hewan->delete();

        return redirect()->route('data_hewan.index')->with('success', 'Data Hewan berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $query = $request->input('q'); // Ambil query pencarian
        $pemilik = DataPemilik::where('nama', 'like', "%{$query}%")
                              ->get(['id_data_pemilik', 'nama']); // Ambil id dan nama pemilik
        
        return response()->json($pemilik); // Kembalikan data sebagai JSON
    }
}
