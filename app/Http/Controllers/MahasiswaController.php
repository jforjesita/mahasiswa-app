<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Menampilkan daftar mahasiswa
    public function index() {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // Menyimpan data mahasiswa baru
    public function store(Request $request) {
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'jurusan' => 'required',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    // Menghapus data mahasiswa
    public function destroy($id) {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}