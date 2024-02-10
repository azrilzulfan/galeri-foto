<x-app-layout>
    <div>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-semibold">{{ Auth::user()->name }}</div>
                <hr class="w-48 h-1 my-4 bg-purple-700 border-0 rounded">
            </div>
            <div>
                <button type="button" data-modal-target="tambahAlbum" data-modal-toggle="tambahAlbum" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Container card album -->
        <div class="grid grid-cols-4 gap-4">
            <!-- Memanggil data album yang dimiliki user -->
            @foreach ($album as $index => $item)
            <!-- Memanggil foto terbaru untuk cover album -->
            @php
                $foto = $item->foto()->latest()->first();
            @endphp
            <!-- Card album -->
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                <a href="{{ route('album.index', $item->id) }}">
                    @if ($foto)
                        <img class="rounded-t-lg object-cover w-full h-60" src="{{ url('storage/' . $foto->lokasi_file) }}" alt="" />
                    @else
                        <div class="h-60 flex justify-center items-center">
                            <p class="text-center">Tidak ada foto.</p>
                        </div>
                    @endif
                </a>
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item->nama_album }}</h5>
                    <p class="mb-3 font-normal text-gray-700">{{ $item->deskripsi }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('album.index', $item->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300">
                            Detail
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                        <button id="dropdownMenuIconHorizontalButton{{ $index }}" data-dropdown-toggle="opsiAlbum{{ $index }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-200 rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                              <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="opsiAlbum{{ $index }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl w-44">
                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton{{ $index }}">
                            <li>
                                <button type="button" data-modal-target="editAlbum{{ $item->id }}" data-modal-toggle="editAlbum{{ $item->id }}" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">Edit</button>
                            </li>
                            <li>
                                <!-- Form delete album -->
                                <form action="{{ route('album.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-gray-100">Hapus</button>
                                </form>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Album -->
            <div id="editAlbum{{ $item->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Album
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="editAlbum{{ $item->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <!-- Form edit album -->
                            <form action="{{ route('album.update', $item->id) }}" method="POST" class="max-w-sm mx-auto">
                                @csrf
                                @method('PUT')
                                <div class="mb-5">
                                    <label for="nama_album" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Album</label>
                                    <input type="text" id="nama_album" name="nama_album" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" value="{{ $item->nama_album }}" required>
                                </div>
                                <div class="mb-5">
                                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                    <textarea id="message" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500" required>{{ $item->deskripsi }}</textarea>
                                </div>
                                <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<!-- Tambah Album -->
<div id="tambahAlbum" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Album
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="tambahAlbum">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <!-- Form add album -->
                <form action="{{ route('album.store') }}" method="POST" class="max-w-sm mx-auto">
                    @csrf
                    <div class="mb-5">
                      <label for="nama_album" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Album</label>
                      <input type="text" id="nama_album" name="nama_album" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5" required>
                    </div>
                    <div class="mb-5">
                      <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                      <textarea id="message" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>
                    <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
