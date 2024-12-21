<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Guru::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'id_mapel' => 'required|integer',
            'id_sekolah' => 'required|integer',
        ]);

        $guru = Guru::create($request->all());
        return response()->json($guru, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Guru::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
        return response()->json($guru, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return response()->json(null, 204);
    }

    public function Login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
        ]);

        $guru = Guru::where('nama', $request->nama)
        ->where('nip', $request->nip)
        ->first();

        if ($guru) {
            return response()->json(['message' => 'Login berhasil', 'data' => $guru], 200);
        } else {
            return response()->json(['message' => 'Nama atau NIP salah'], 401);
        }
    }
}
