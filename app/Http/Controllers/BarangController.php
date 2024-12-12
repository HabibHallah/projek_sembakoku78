<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang; // Pastikan model Barang sudah ada
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    
    // Menampilkan form input barang
    public function create()
    {
        $barangs = Barang::all();

        // Menampilkan view dengan data barang
        return view('content.TambahData.barang', compact('barangs'));
    }

    // Menyimpan data barang
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('barang-fotos', 'public');
        }

        // Simpan data ke database
        Barang::create($validatedData);

        return redirect('TambahData/data-barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Menampilkan form edit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('content.TambahData.edit-barang', compact('barang'));
    }

    // Memproses pembaruan data barang
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang = Barang::findOrFail($id);

        // Perbarui foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($barang->foto) {
                Storage::delete('public/' . $barang->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('barang-fotos', 'public');
        }

        $barang->update($validatedData);

        return redirect()->route('data-barang')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus foto jika ada
        if ($barang->foto) {
            Storage::delete('public/' . $barang->foto);
        }

        // Hapus data dari database
        $barang->delete();

        return redirect()->route('data-barang')->with('success', 'Barang berhasil dihapus!');
    }

}
