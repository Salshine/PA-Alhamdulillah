<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Prodi;
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
        $prodiId = $request->prodiId;

        $mahasiswas = Mahasiswa::create([
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'password' => $password,
            'prodiId' => $prodiId
        ]);
        if ($mahasiswas) {
            return response()->json([
                'status' => 'Sukses',
                'data' => [
                    'mahasiswa' => $mahasiswas,
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'Gagal',
                'message' => "Gagal menambahkan mahasiswa"
            ]);
        }
    }



    public function login(Request $request)
    {
        $nim = $request->nim;
        $password = $request->password;

        $mahasiswas = Mahasiswa::where('nim', $nim)->first();

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

        // $mahasiswas->update(['token' => Str::random(36)]);

        return response()->json([
            'status' => 'Success',
            'data' => $mahasiswas
        ], 200);
    }

    public function getMahasiswas()
    {
        $mahasiswas = Mahasiswa::with('prodis')->get();

        if ($mahasiswas) {
            return response()->json([
                'status' => 'Success',
                'message' => 'all users grabbed',
                'mahasiswa' => $mahasiswas
            ], 200);
        } else {
            return response()->json([
                'status' => 'Gagal',
                'message' => 'gagal mengambil data mahasiswa'
            ], 400);
        }
    }


    public function getMahasiswaByToken(Request $request)
    {
        $user = $request->user;
        // echo $user;
        return response()->json([
            'status' => 'Success',
            'message' => 'selamat datang ' . $user->nama,
            'mahasiswa' => $user
        ], 200);
    }

    public function getMahasiswasByNim(Request $request)
    {
        $nim = $request->nim;

        $mahasiswas = Mahasiswa::where('nim', $nim)->first();
        $mahasiswas->matkuls;

        return response()->json([
            'status' => 'Success',
            'mahasiswa' => $mahasiswas,
        ], 200);
    }



    public function getMatkuls()
    {
        $matkuls = Matkul::all();

        return response()->json([
            'status' => 'Success',
            'matakuliah' => $matkuls
        ], 200);
    }
    public function storeMatakuliah(Request $request)
    {
        if ($request->user->nim == $request->nim) {
            $nim = $request->nim;
            $matakuliahId = $request->matakuliahId;

            $mahasiswa = Mahasiswa::where('nim', $nim)->first();
            $mahasiswa->matkuls()->attach($matakuliahId);
            $mahasiswa->matkuls;

            return response()->json([
                'status' => 'Success',
                'message' => 'Sukses menambahkan matakuliah',
                'data' => $mahasiswa
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Belum authorization'
            ], 400);
        }
    }
    public function deleteMatakuliah(Request $request)
    {
        if ($request->user->nim == $request->nim) {
            $nim = $request->nim;
            $matakuliahId = $request->matakuliahId;

            $mahasiswa = Mahasiswa::where('nim', $nim)->first();
            $mahasiswa->matkuls()->detach($matakuliahId);
            $mahasiswa->matkuls;

            return response()->json([
                'status' => 'Success',
                'message' => 'Sukses menghapus matakuliah',
                'data' => $mahasiswa
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Belum authorization'
            ], 400);
        }
    }
}
