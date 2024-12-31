<?php

namespace App\Http\Controllers;

use App\Models\KelasMapel;
use Illuminate\Http\Request;

class KelasMapelController extends Controller
{
    /**
     * Menampilkan semua data kelas_mapel atau berdasarkan id_kelas atau id_mapel.
     */
    public function index()
    {
        // Query berdasarkan id_kelas jika tersedia
        if (request()->query('id_kelas')) {
            return response()->json(KelasMapel::where('id_kelas', request()->query('id_kelas'))->get());
        }

        // Query berdasarkan id_mapel jika tersedia
        if (request()->query('id_mapel')) {
            return response()->json(KelasMapel::where('id_mapel', request()->query('id_mapel'))->get());
        }

        // Jika tidak ada filter, kembalikan semua data kelas_mapel
        return response()->json(KelasMapel::all());
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        // Biasanya digunakan untuk menampilkan form, bisa kosong untuk API.
    }

    /**
     * Menyimpan data kelas_mapel baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',  // memastikan id_kelas ada di tabel kelas
            'id_mapel' => 'required|integer|exists:mapels,id_mapel',  // memastikan id_mapel ada di tabel mapels
        ], [
            'id_kelas.required' => 'ID Kelas wajib diisi',
            'id_mapel.required' => 'ID Mapel wajib diisi',
            'id_kelas.exists' => 'ID Kelas tidak ditemukan',
            'id_mapel.exists' => 'ID Mapel tidak ditemukan',
        ]);

        // Membuat record baru
        $kelasMapel = KelasMapel::create($request->all());
        return response()->json($kelasMapel, 201);
    }

    /**
     * Menampilkan data kelas_mapel berdasarkan ID.
     */
    public function show(string $id)
    {
        // Menemukan kelas_mapel berdasarkan ID
        $kelasMapel = KelasMapel::find($id);
        
        // Jika tidak ditemukan, kembalikan error 404
        if (!$kelasMapel) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($kelasMapel);
    }

    /**
     * Menampilkan form untuk mengedit data kelas_mapel (biasanya untuk web).
     */
    public function edit(string $id)
    {
        // Bisa kosong jika hanya untuk API.
    }

    /**
     * Memperbarui data kelas_mapel berdasarkan ID.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',
            'id_mapel' => 'required|integer|exists:mapels,id_mapel',
        ]);

        // Mencari data yang akan diperbarui
        $kelasMapel = KelasMapel::find($id);

        // Jika data tidak ditemukan, kembalikan error 404
        if (!$kelasMapel) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Memperbarui data kelas_mapel
        $kelasMapel->update($request->all());
        return response()->json($kelasMapel, 200);
    }

    /**
     * Menghapus data kelas_mapel berdasarkan ID.
     */
    public function destroy(string $id)
    {
        // Mencari kelas_mapel berdasarkan ID
        $kelasMapel = KelasMapel::find($id);

        // Jika data tidak ditemukan, kembalikan error 404
        if (!$kelasMapel) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Menghapus data kelas_mapel
        $kelasMapel->delete();
        return response()->json(null, 204);  // Kode status 204 artinya tidak ada konten setelah dihapus
    }
}