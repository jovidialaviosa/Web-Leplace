<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json([
            'data' => $mahasiswa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama" => "required|string",
            "NIM" => "required|string|unique:mahasiswas,NIM",
            "email" => "required|string|unique:mahasiswas,email",
            "password" => "required|string"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Gagal Registrasi",
                "errors" => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
        $validated = $validator->validated();
        $validated["password"] = bcrypt($validated["password"]);
        try {
            $mahasiswa = Mahasiswa::create($validated);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Gagal Registrasi",
                "error" => $e->getMessage()
            ]);
        }
        return response()->json([
            "message" => "Registrasi Berhasil",
            "data" => $mahasiswa
        ]);
    }

    public function upload_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto'     => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $mahasiswa = Mahasiswa::find($id);
        if ($request->hasFile('foto')) {
            $foto = $request->foto;
            $name = $foto->getClientOriginalName();
            $foto->storeAs('assets/img', $name, 'public');
            Storage::delete('public/assets/img' . $mahasiswa->foto);

            //update post with new image
            $mahasiswa->update([
                'foto'     => $name,
            ]);
        }
        return response()->json([
            'data' => $mahasiswa
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return response()->json([
            'data' => $mahasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update_data(Request $request, Mahasiswa $mahasiswa)
    {
        // $mahasiswa->nama = $request->nama;
        // $mahasiswa->NIM = $request->NIM;
        // $mahasiswa->email = $request->email;
        // $mahasiswa->password = $request->password;
        $mahasiswa->foto = $request->foto;
        $mahasiswa->save();

        return response()->json([
            'data' => $mahasiswa
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return response()->json([
            'message' => 'Data Mahasiswa Dihapus'
        ], 204);
    }
}
