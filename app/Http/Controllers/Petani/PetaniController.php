<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class PetaniController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        // Cek apakah ada gudang atau distributor di desa yang sama dengan petani
        $isServiceAvailable = User::whereIn('role', ['gudang', 'distributor'])
            ->where('desa', $currentUser->desa)
            ->exists();

        return view('petani.index', [
            'title' => 'Dashboard Petani',
            'user' => $currentUser->name,
            'isServiceAvailable' => $isServiceAvailable,
            'userDesa' => $currentUser->desa,
        ]);
    }
}
