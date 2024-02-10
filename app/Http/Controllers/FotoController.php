<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    // Memanggil data foto berdasarkan album yang dipilih
    public function index($albumID)
    {
        $album = Album::findOrFail($albumID);
        $foto = Foto::where('album_id', $albumID)->get();
        return view('album', compact('foto', 'albumID', 'album'));
    }

    // Menambahkan data foto
    public function store(Request $request, $albumID)
    {
        $data = $request->all();
        $data['lokasi_file'] = $request->file('lokasi_file')->store('img', 'public');
        Foto::create($data);

        return redirect()->route('album.index', $albumID)->with('success', 'Foto created successfully.');
    }

    // Menampilkan detail foto
    public function show($id)
    {
        $fotoTerbaru = Foto::latest()->take(18)->get();
        $foto = Foto::findOrFail($id);
        return view('foto', compact('foto', 'fotoTerbaru'));
    }

    // Mengubah data foto
    public function update(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'judul_foto' => 'required',
            'deskripsi_foto' => 'required',
        ]);

        //  Mengambil data berdasarkan id
        $foto = Foto::findOrFail($id);
        //  Mengubah data didalam database
        $foto->update($request->all());

        return redirect()->back()->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy($id)
    {
        //  Mengambil data berdasarkan id
        $foto = Foto::findOrFail($id);
        //  Mengahpus data didalam database
        $foto->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus');
    }
}
