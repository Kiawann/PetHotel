<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriHewan;
use Illuminate\Http\Request;

class KategoriHewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_hewan = KategoriHewan::all();
    
        return view('admin.kategori-hewan', compact('kategori_hewan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori-hewan-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Menyimpan data
        KategoriHewan::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kategori_hewan.index')->with('success', 'Kategori Hewan berhasil ditambahkan.');
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
        $kategori = KategoriHewan::findOrFail($id);
        return view('admin.kategori-hewan-edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Mencari kategori hewan berdasarkan id
        $kategori = KategoriHewan::findOrFail($id);

        // Mengupdate kategori
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kategori_hewan.index')->with('success', 'Kategori Hewan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari kategori hewan berdasarkan id
        $kategori = KategoriHewan::findOrFail($id);

        // Menghapus kategori hewan
        $kategori->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('kategori_hewan.index')->with('success', 'Kategori Hewan berhasil dihapus.');
    }
}
