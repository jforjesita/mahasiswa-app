<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // READ: Menampilkan semua data mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // CREATE: Menyimpan data baru dengan Validasi
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim|max:20',
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->back()->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    // UPDATE: Menampilkan halaman edit (Form Edit)
    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    // UPDATE: Memperbarui data di database dengan Validasi
    public function update(Request $request, $id)
    {
        $mhs = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|max:20|unique:mahasiswas,nim,' . $mhs->id,
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        $mhs->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diubah!');
    }

    // DELETE: Menghapus data
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}