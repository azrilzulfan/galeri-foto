<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    // Memanggil data foto terbaru
    public function index()
    {
        // Mengambil 24 data foto terbaru
        $foto = Foto::latest()->take(24)->get();
        return view('beranda', compact('foto'));
    }
}
