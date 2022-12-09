<?php

namespace App\Http\Controllers;

use App\Models\MahasiswasModel;
use App\Models\MatkulsModel;
use App\Models\ProdisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
        $nim = $request->nim;
        $nama = $request->nama;
        $angkatan = $request->angkatan;
        $password = Hash::make($request->password);
        // $prodi = ?????????

        $mahasiswas = MahasiswasModel::create([
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'password' => $password
        ]);

        return response()->json([
            'status' => 'Sukses',
            'data' => [
                'mahasiswa' => $mahasiswas,
            ]
        ]);
    }



    public function login(Request $request)
    {
        $nim = $request->nim;
        $password = $request->password;

        $mahasiswas = MahasiswasModel::where('nim', $nim)->first();

        if (!$mahasiswas) {
            return response()->json([
                'status' => 'Error',
                'message' => 'user not exist',
            ], 404);
        }

        if (!Hash::check($password, $mahasiswas->password)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'wrong password',
            ], 400);
        }

        $mahasiswas->token = Str::random(36); //
        $mahasiswas->save();


        return response()->json([
            'status' => 'Success',
            'data' => [
                'mahasiswa' => $mahasiswas,
            ]
        ], 200);
    }

    public function getMahasiswas()
    {
        $mahasiswas = MahasiswasModel::all();

        return response()->json([
            'status' => 'Success',
            'message' => 'all users grabbed',
            'data' => [
                'users' => $mahasiswas,
            ]
        ], 200);
    }


    public function getMahasiswasByToken(Request $request)
    {
        // $mahasiswas = $request->user;

        return response()->json([
            'status' => 'Success',
            'message' => 'selamat datang ' . $mahasiswas->nama,
        ], 200);
    }

    public function getMahasiswasByNim(Request $request)
    {
        $nim = $request->nim;

        $mahasiswas = MahasiswasModel::where('nim', $nim)->first();

        return response()->json([
            'status' => 'Success',
            'data' => [
                'mahasiswa' => $mahasiswas,
            ]
        ], 200);
    }

    public function getProdis()
    {
        $prodis = ProdisModel::all();

        return response()->json([
            'status' => 'Success',
            'data' => [
                'users' => $prodis,
            ]
        ], 200);
    }

    public function getMatkuls()
    {
        $matkuls = MatkulsModel::all();

        return response()->json([
            'status' => 'Success',
            'data' => [
                'users' => $matkuls,
            ]
        ], 200);
    }
    //
}
