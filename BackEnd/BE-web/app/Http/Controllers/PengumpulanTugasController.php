<?php

namespace App\Http\Controllers;

use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumpulanTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumpulanTugas = PengumpulanTugas::all();
        return response()->json([
            'data' => $pengumpulanTugas
        ]);
    }

    // public function join()
    // {
    //     $pengumpulanTugas = DB::table('pengumpulan_tugas')
    //         ->join('mahasiswas', 'id', '=', 'mahasiswa_id')
    //         ->join('tugas', 'id', '=', 'tugas_id')
    //         ->select('pengumpulan_tugas.*', 'mahasiswas.nama', 'tugas.judul')
    //         ->get();
    //     //$pengumpulanTugas = PengumpulanTugas::all();
    //     return response()->json([
    //         'data' => $pengumpulanTugas
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PengumpulanTugas $pengumpulanTugas)
    {
        $file_tugas = $request->file_tugas;
        $name = $file_tugas->getClientOriginalName();
        $file_tugas->storeAs('assets/Pengumpulan', $name, 'public');
        $pengumpulanTugas = PengumpulanTugas::create([
            "tugas_id" => $request->tugas_id,
            "mahasiswa_id" => $request->mahasiswa_id,
            "kumpulan_tugas" => $name,
        ]);
        return response()->json([
            'data' => $pengumpulanTugas
        ]);
    }

    public function nilai(Request $request, PengumpulanTugas $pengumpulanTugas, $id)
    {
        $pengumpulanTugas = PengumpulanTugas::find($id);
        $nilai = $request->nilai;
        $pengumpulanTugas->update([
            'nilai' => $nilai,
        ]);
        return response()->json([
            'data' => $pengumpulanTugas
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => PengumpulanTugas::findOrFail($id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengumpulanTugas  $pengumpulanTugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengumpulanTugas $pengumpulanTugas, $id)
    {
        $pengumpulanTugas = PengumpulanTugas::FindOrFail($id);
        $pengumpulanTugas->delete($id);
        return ["Tugas Anda Telah Dihapus"];

        return response()->json([
            'data' => $pengumpulanTugas
        ]);
    }
}
