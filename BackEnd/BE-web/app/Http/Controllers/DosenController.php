<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \App\Models\Dosen $dosen
     * @return \Illuminate\Http\Response
     */
    public function index(Dosen $dosen)
    {
        $dosen = Dosen::all();
        return response()->json([
            'data' => $dosen
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
            "NIP" => "required|string|unique:dosens,NIP",
            "email" => "required|string|unique:dosens,email",
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
            $dosen = Dosen::create($validated);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Gagal Registrasi",
                "error" => $e->getMessage()
            ]);
        }
        return response()->json([
            "message" => "Registrasi Berhasil",
            "data" => $dosen
        ]);
    }

    public function upload_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto'     => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dosen = Dosen::find($id);
        if ($request->hasFile('foto')) {
            $foto = $request->foto;
            $name = $foto->getClientOriginalName();
            $foto->storeAs('assets/img', $name, 'public');
            Storage::delete('public/assets/img' . $dosen->foto);
            $dosen->update([
                'foto'     => $name,
            ]);
        }
        return response()->json([
            'data' => $dosen
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        return response()->json([
            'data' => $dosen
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        // $dosen->nama = $request->nama;
        // $dosen->NIP = $request->NIP;
        // $dosen->email = $request->email;
        // $dosen->password = $request->password;
        $dosen->foto = $request->foto;
        $dosen->save();

        return response()->json([
            'data' => $dosen
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return response()->json([
            'message' => 'Data Dosen Dihapus'
        ], 204);
    }
}
