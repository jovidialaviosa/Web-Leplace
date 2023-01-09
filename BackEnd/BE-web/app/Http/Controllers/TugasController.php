<?php

namespace App\Http\Controllers;

use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Dotenv\Store\File\Paths;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tugas = Tugas::all();
        return response()->json([
            'data' => $tugas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tugas $tugas)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'file_tugas' => 'required|mimes:pdf,docx,doc,pptx,ppt,zip,rar'
        ]);
        $file_tugas = $request->file_tugas;
        $name = $file_tugas->getClientOriginalName();
        $file_tugas->storeAs('assets/tugas', $name, 'public');
        $tugas = Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_tugas' => $name
        ]);
        return response()->json([
            'data' => $tugas
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
            'data' => Tugas::findOrFail($id)
        ]);
    }

    // public function download(Request $request)
    // {
    //     if (Storage::disk('public')->exists("/assets/tugas $request->file")) {
    //         //error_log("hei");
    //         $path = Storage::disk('public')->path("/assets/tugas $request->file");
    //         //error_log("hei");
    //         $content = file_get_contents($path);
    //         error_log("hei");
    //         return response($content)->withHeaders([
    //             'Content-Type' => mime_content_type($path)
    //         ]);
    //     }
    //     return redirect('/404');
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugas $tugas)
    {
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->file_tugas = $request->file_tugas;
        $tugas->save();

        return response()->json([
            'data' => $tugas
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugas $tugas, $id)
    {
        $tugas = Tugas::FindOrFail($id);
        $tugas->delete($id);
        return ["Tugas Berhasil Dihapus"];

        return response()->json([
            'data' => $tugas
        ]);
    }
}
