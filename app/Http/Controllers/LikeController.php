<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Menambahkan data like
    public function store($fotoID)
    {
        // Memasukkan data kedalam
        Like::create([
            'foto_id' => $fotoID,
            'users_id' => Auth::user()->id,
            'tanggal_like' => now(),
        ]);

        return redirect()->back();
    }

    // Menghapus data like
    public function destroy($id)
    {
        //  Mengambil data berdasarkan id
        $like = Like::findOrFail($id);
        //  Mengahpus data didalam database
        $like->delete();

        return redirect()->back();
    }
}
