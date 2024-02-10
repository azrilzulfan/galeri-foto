<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    // Menambahkan data komentar
    public function store(Request $request, $fotoID)
    {
        // Validasi input data
        $request->validate([
            'isi_komentar' => 'required'
        ]);

        // Memasukkan data kedalam database
        Komentar::create([
            'foto_id' => $fotoID,
            'users_id' => Auth::user()->id,
            'isi_komentar' => $request->isi_komentar,
        ]);

        return redirect()->back();
    }

    // Menghapus data komentar
    public function destroy($id)
    {
        //  Mengambil data berdasarkan id
        $komentar = Komentar::findOrFail($id);
        //  Mengahpus data didalam database
        $komentar->delete();

        return redirect()->back();
    }
}
