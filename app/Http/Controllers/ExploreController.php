<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    // Memanggil data foto dan album terbaru
    public function index()
    {
        $foto = Foto::latest()->get();
        $album = Album::latest()->get();
        return view('explore', compact('foto','album'));
    }
}
