<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan data mahasiswa
        $mahasiswas = Mahasiswa::all();
        return response()->json([
            'data' => $mahasiswas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi data
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required',
        ]);

        //menyimpan data mahasiswa
        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'data' => $mahasiswa,
            'message' => 'Mahasiswa created successfully.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //menampilkan data mahasiswa berdasarkan id
        $mahasiswa = Mahasiswa::findOrFail($id);

        return response()->json([
            'data' => $mahasiswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validasi data
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'nama' => 'required',
        ]);

        //mengupdate data mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());

        return response()->json([
            'data' => $mahasiswa,
            'message' => 'Mahasiswa updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus data mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return response()->json([
            'message' => 'Mahasiswa deleted successfully.',
        ]);
    }
}
