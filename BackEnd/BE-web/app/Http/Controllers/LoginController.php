<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|string",
            "password" => "required|string"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Gagal Login",
                "errors" => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
        $validated = $validator->validated();

        $user = Dosen::where("email", $validated["email"])->first();
        if ($user == null) {
            $user = Mahasiswa::where("email", $validated["email"])->first();
        }

        if ($user !== null) {

            //if (Hash::check($validated["password"], $user->password)) {
            $password = Hash::check($validated["password"], $user->password);
            if ($password == true) {
                return response()->json([
                    "message" => "Login Berhasil",
                    "data" => $user
                ]);
            } else {
                return response()->json([
                    "message" => "Password Salah",
                ], Response::HTTP_NOT_ACCEPTABLE);
            }
        } else {
            return response()->json([
                "message" => "Login Gagal",
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
