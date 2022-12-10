<?php

namespace App\Http\Controllers;

use App\Models\Prodi;

class ProdiController extends Controller
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

    public function getProdis()
    {
        $prodis = Prodi::all();

        return response()->json([
            'status' => 'Success',
            'prodi' => $prodis
        ], 200);
    }
}
