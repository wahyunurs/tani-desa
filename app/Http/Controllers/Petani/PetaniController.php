<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        return view('petani.index', [
            'title' => 'Dashboard Petani',
            'user' => Auth::user()->name,
        ]);
    }
}
