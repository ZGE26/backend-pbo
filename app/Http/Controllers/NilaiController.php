<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Jika kedua parameter id_member dan id_mapel diberikan
    if (request()->query('id_member') && request()->query('id_mapel')) {
        return response()->json(
            Nilai::where('id_member', request()->query('id_member'))
                ->where('id_mapel', request()->query('id_mapel'))
                ->first()
        );
    }

    // Jika hanya id_mapel yang diberikan
    if (request()->query('id_mapel')) {
        return response()->json(
            Nilai::where('id_mapel', request()->query('id_mapel'))->get()
        );
    }

    // Jika hanya id_member yang diberikan
    if (request()->query('id_member')) {
        return response()->json(
            Nilai::where('id_member', request()->query('id_member'))->get()
        );
    }

    // Jika tidak ada parameter yang diberikan, tampilkan semua nilai
    return Nilai::all();
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
            'id_member' => 'required|string|max:255',
            'id_mapel' => 'required|integer',
            'nilai' => 'required|numeric',
        ]);

        $nilai = Nilai::create($request->all());
        return response()->json($nilai, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Nilai::findOrFail($id);
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
        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->all());
        return response()->json($nilai, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return response()->json(null, 204);
    }
}
