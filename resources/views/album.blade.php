<x-app-layout>
    <div>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-semibold">{{ $album->nama_album }}</div>
                <div>{{ $album->deskripsi }}</div>
                <hr class="w-48 h-1 my-4 bg-purple-700 border-0 rounded">
            </div>
            @if (Auth::user()->id == $album->users_id)
                <div>
                    <button type="button" data-modal-target="tambahFoto" data-modal-toggle="tambahFoto" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <!-- Card Album -->
    <div class="columns-6 max-w-full gap-4 my-0 mx-auto">
        <!-- Memanggil data album -->
        @foreach ($foto as $index => $item)
            <a href="{{ route('foto.show', $item->id) }}" class="block">
                <div class="relative w-full mb-4 overflow-hidden group">
                    <img class="h-auto w-full block rounded-lg transition-transform duration-300 transform hover:scale-105" src="{{ url('storage/' . $item->lokasi_file) }}" alt="">
                    <div class="overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 transition-opacity duration-300 p-4 group-hover:opacity-100 group-hover:rounded-lg rounded-lg">
                        <p class="text-white text-lg font-semibold">{{ $item->judul_foto }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

</x-app-layout>

<!-- Tambah Foto -->
<div id="tambahFoto" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Foto
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="tambahFoto">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <form action="{{ route('foto.store', $albumID) }}" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto">
                    @csrf
                    <div class="mb-5">
                      <label for="judul_foto" class="block mb-2 text-sm font-medium text-gray-900">Judul Foto</label>
                      <input type="text" id="judul_foto" name="judul_foto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>
                    <div class="mb-5">
                      <label for="deskripsi_foto" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Foto</label>
                      <textarea id="deskripsi_foto" name="deskripsi_foto" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>
                    <div class="mb-5">
                        <input type="hidden" name="tanggal_unggah" id="tanggal_unggah" value="{{ now() }}">
                    </div>
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="lokasi_file">File Foto</label>
                        <input type="file" accept="image/*" name="lokasi_file" id="lokasi_file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                    </div>
                    <div class="mb-5">
                        <input  type="hidden" name="album_id" id="album_id" value="{{ $albumID }}">
                    </div>
                    <div class="mb-5">
                        <input type="hidden" name="users_id" id="users_id" value="{{ Auth::user()->id }}">
                    </div>
                    <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
