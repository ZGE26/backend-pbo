<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;

class SekolahController extends Controller
{
    public function index()
    {
        if (request()->query('id_sekolah')) {
            return response()->json(Sekolah::where('id_sekolah', request()->query('id_sekolah'))->first());
        }

        if (request()->query('nama_sekolah')) {
            return response()->json(Sekolah::where('nama_sekolah', request()->query('nama_sekolah'))->first());
        }

        return Sekolah::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $sekolah = Sekolah::create($request->all());
        return response()->json($sekolah, 201);
    }

    public function show($id)
    {
        return Sekolah::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->update($request->all());
        return response()->json($sekolah, 200);
    }

    public function destroy($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->delete();
        return response()->json(null, 204);
    }
}