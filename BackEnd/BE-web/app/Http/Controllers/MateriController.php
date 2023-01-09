<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Error;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materi = Materi::all();
        return response()->json([
            'data' => $materi
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Materi $materi)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'minggu_ke' => 'required',
            'file_materi' => 'required|mimes:pdf,docx,doc,pptx,ppt,zip,rar'
        ]);
        $file_materi = $request->file('file_materi');
        $name = $file_materi->getClientOriginalName();
        $file_materi->storeAs('assets/materi', $name, 'public');
        $materi = Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'minggu_ke' => $request->minggu_ke,
            'file_materi' => $name
        ]);
        return response()->json([
            'data' => $materi
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        return response()->json([
            'data' => $materi
        ]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Materi  $materi
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Materi $materi)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->minggu_ke = $request->minggu_ke;
        $materi->file_materi = $request->file_materi;
        $materi->save();

        return response()->json([
            'data' => $materi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        $materi->delete();
        return ["Materi Telah Dihapus"];

        return response()->json([
            'data' => $materi
        ]);
    }
}
