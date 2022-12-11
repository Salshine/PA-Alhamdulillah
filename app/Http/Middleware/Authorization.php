<?php

namespace App\Http\Middleware;

use App\Models\Mahasiswa;
use Closure;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('token') ?? $request->query('token');
        if (!$token) {
            return response()->json([
                'status' => '400',
                'message' => 'token not provided',
            ], 400);
        }

        $mahasiswas = Mahasiswa::where('token', $token)->first();
        if (!$mahasiswas) {
            return response()->json([
                'status' => '400',
                'message' => 'invalid token',
            ], 400);
        }
        // echo $mahasiswas;
        $request->user = $mahasiswas;
        return $next($request->user);
    }
}
