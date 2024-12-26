<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->query('nisn')) {
            return response()->json(Siswa::where('nisn', request()->query('nisn'))->first());
        }

        return response()->json(Siswa::where('id_kelas', request()->query('id_kelas'))->get());


        if (request()->query('id_kelas')) {
            return response()->json(Siswa::where('id_kelas', request()->query('id_kelas'))->first());
        }
        return Siswa::all();
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
            'nisn' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'id_kelas' => 'required|integer',
            'gender' => 'required|string|max:255',
        ]);

        $siswa = Siswa::create($request->all());
        return response()->json($siswa, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Siswa::findOrFail($id);
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
        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return response()->json($siswa, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return response()->json(null, 204);
    }
}