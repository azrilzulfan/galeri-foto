<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    // Memanggil data album yang dimiliki user yang sedang login
    public function index()
    {
        $album = Album::where('users_id', Auth::user()->id)->get();
        return view('profile', compact('album'));
    }

    // Menambahkan data album
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'nama_album'=>'required',
            'deskripsi'=>'required'
        ]);

        // Data user yang sedang login
        $UserID = Auth::user()->id;

        //  Memasukkan data kedalam database
        Album::create([
            'nama_album'=> $request->nama_album,
            'deskripsi'=> $request->deskripsi,
            'tanggal_dibuat' => now(),
            'users_id'=> $UserID,
        ]);

        return redirect()->route('profile.index')->with('success','Album berhasil dibuat!');
    }

    // Mengubah data album
    public function update(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'nama_album' => 'required',
            'deskripsi' => 'required',
        ]);

        //  Mengambil data berdasarkan id
        $album = Album::findOrFail($id);
        //  Mengubah data didalam database
        $album->update($request->all());

        return redirect()->route('profile.index')->with('success', 'Album berhasil diperbarui.');
    }

    // Menghapus data album
    public function destroy($id)
    {
        //  Mengambil data berdasarkan id
        $album = Album::findOrFail($id);
        //  Mengahpus data didalam database
        $album->delete();

        return redirect()->route('profile.index')->with('success', 'Album berhasil dihapus');
    }
}
