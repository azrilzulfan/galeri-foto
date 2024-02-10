<x-app-layout>
    <div class="container px-44 mx-auto">
        <div class="flex bg-white shadow-xl">
            <div class="w-1/2">
                <img class="h-auto w-full rounded-lg shadow" src="{{ url('storage/' . $foto->lokasi_file) }}" alt="">
            </div>
            <div class="w-1/2 p-10 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-5">
                        <div>
                            <div class="text-lg font-semibold">{{ $foto->users->name }}</div>
                            <div class="text-xs text-purple-700 font-medium">{{ $foto->users->nama_lengkap }}</div>
                        </div>
                        <!-- Muncul saat user pemilik foto yang melihat -->
                        @if (Auth::user()->id === $foto->users->id)
                            <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="opsiAlbum" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-100 rounded-full hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                </svg>
                            </button>
                            <!-- Opsi Foto -->
                            <div id="opsiAlbum" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl w-44">
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <button type="button" data-modal-target="editFoto{{ $foto->id }}" data-modal-toggle="editFoto{{ $foto->id }}" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">Edit</button>
                                    </li>
                                    <li>
                                        <!-- Form delete foto -->
                                        <form action="{{ route('foto.destroy', $foto->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-gray-100">Hapus</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="whitespace-normal flex flex-col gap-2">
                        <div class="text-2xl font-semibold">{{ $foto->judul_foto }}</div>
                        <div class="">{{ $foto->deskripsi_foto }}</div>
                    </div>
                </div>
                <div>
                    <div class="font-medium mb-5">Komentar</div>
                    <!-- Memanggil komentar -->
                    @if ($foto->komentarfoto->count() > 0)
                        @foreach ($foto->komentarfoto as $index => $komentar)
                            <div class="flex items-center gap-2 mb-2">
                                <div>-</div>
                                <div class="font-medium">{{ $komentar->users->name }}</div>
                                <div>{{ $komentar->isi_komentar }}</div>
                                <!-- Muncul saat user yang berkomentar dan user pemilik foto -->
                                @if (Auth::user()->id === $foto->users->id || Auth::user()->id === $komentar->users->id)
                                    <div>
                                        <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="opsiKomentar{{ $index }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-50 rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                            <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                            </svg>
                                        </button>
                                        <!-- Opsi Foto -->
                                        <div id="opsiKomentar{{ $index }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl w-44">
                                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                                                <li>
                                                    <!-- Form delete komentar -->
                                                    <form action="{{ route('komentar.destroy', $komentar->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-gray-100">Hapus</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        Tidak ada komentar.
                    @endif
                </div>
                <div>
                    <div class="flex justify-between items-center">
                        <div class="text-lg font-semibold">
                            {{ $foto->komentarfoto->count() }} Komentar
                        </div>
                        <div>
                            <!-- Muncul saat user sudah like foto -->
                            @if ($foto->hasLike(Auth::user()->id))
                                <!-- Delete like user yang sedang login -->
                                @foreach ($foto->likefoto->where('users_id', Auth::user()->id) as $like)
                                    <form action="{{ route('like.destroy', $like->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 p-2 text-sm font-medium text-center text-gray-900 bg-gray-100 rounded-full hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-50">
                                            <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="m12.7 20.7 6.2-7.1c2.7-3 2.6-6.5.8-8.7A5 5 0 0 0 16 3c-1.3 0-2.7.4-4 1.4A6.3 6.3 0 0 0 8 3a5 5 0 0 0-3.7 1.9c-1.8 2.2-2 5.8.8 8.7l6.2 7a1 1 0 0 0 1.4 0Z"/>
                                            </svg>
                                            <span>{{ $foto->likefoto->count() }}</span>
                                        </button>
                                    </form>
                                @endforeach
                            @else
                                <!-- Form add like -->
                                <form action="{{ route('like.store', $foto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-2 p-2 text-sm font-medium text-center text-gray-900 bg-gray-100 rounded-full hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-50">
                                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"/>
                                        </svg>
                                        <span>{{ $foto->likefoto->count() }}</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="mt-2">
                        <!-- Form add komentar -->
                        <form action="{{ route('komentar.store', $foto->id) }}" method="POST">
                            @csrf
                            <div class="relative">
                                <input type="text" id="isi_komentar" name="isi_komentar" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-purple-500 focus:border-purple-500" required>
                                <button type="submit" class="absolute top-1/2 right-2.5 transform -translate-y-1/2 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-full text-sm px-2 py-2">
                                    <svg class="w-6 h-6 text-white transform rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12 2c.4 0 .8.3 1 .6l7 18a1 1 0 0 1-1.4 1.3L13 19.5V13a1 1 0 1 0-2 0v6.5L5.4 22A1 1 0 0 1 4 20.6l7-18a1 1 0 0 1 1-.6Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-10">
        <div class="text-center font-semibold text-xl mb-10">Lainnya untuk dijelajahi</div>
        <div>
            <!-- Card Foto Terbaru-->
            <div class="columns-6 max-w-full gap-4 my-0 mx-auto">
                @if ($fotoTerbaru)
                    @foreach ($fotoTerbaru as $index => $item)
                        <a href="{{ route('foto.show', $item->id) }}" class="block">
                            <div class="relative w-full mb-4 overflow-hidden group">
                                <img class="h-auto w-full block rounded-lg transition-transform duration-300 transform hover:scale-105" src="{{ url('storage/' . $item->lokasi_file) }}" alt="">
                                <div class="overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 transition-opacity duration-300 p-4 group-hover:opacity-100 group-hover:rounded-lg rounded-lg">
                                    <p class="text-white text-lg font-semibold">{{ $item->judul_foto }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Edit Foto -->
<div id="editFoto{{ $foto->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Foto
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="editFoto{{ $foto->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <form action="{{ route('foto.update', $foto->id) }}" method="POST" class="max-w-sm mx-auto">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="judul_foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Foto</label>
                        <input type="text" id="judul_foto" name="judul_foto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" value="{{ $foto->judul_foto }}" required>
                    </div>
                    <div class="mb-5">
                        <label for="deskripsi_foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Foto</label>
                        <textarea id="message" name="deskripsi_foto" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500" required>{{ $foto->deskripsi_foto }}</textarea>
                    </div>
                    <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
