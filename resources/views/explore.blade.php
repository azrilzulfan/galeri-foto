<x-app-layout>
    <div class="w-full mx-auto">
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50" id="explore" data-tabs-toggle="#exploreContent" role="tablist">
                <li class="me-2">
                    <button id="foto-tab" data-tabs-target="#foto" type="button" role="tab" aria-controls="foto" aria-selected="true" class="inline-block p-4 text-purple-600 hover:bg-gray-100">Foto</button>
                </li>
                <li class="me-2">
                    <button id="album-tab" data-tabs-target="#album" type="button" role="tab" aria-controls="album" aria-selected="false" class="inline-block p-4 text-purple-600 rounded-ss-lg hover:bg-gray-100">Album</button>
                </li>
            </ul>
            <div id="exploreContent">
                <div class="hidden p-4 bg-white rounded-lg md:p-8" id="foto" role="tabpanel" aria-labelledby="foto-tab">
                    <!-- Card Foto -->
                    <div class="columns-6 max-w-full gap-4 my-0 mx-auto">
                        <!-- Memanggil data foto -->
                        @forelse ($foto as $index => $item)
                            <a href="{{ route('foto.show', $item->id) }}" class="block">
                                <div class="relative w-full mb-4 overflow-hidden group">
                                    <img class="h-auto w-full block rounded-lg transition-transform duration-300 transform hover:scale-105" src="{{ url('storage/' . $item->lokasi_file) }}" alt="">
                                    <div class="overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 transition-opacity duration-300 p-4 group-hover:opacity-100 group-hover:rounded-lg rounded-lg">
                                        <p class="text-white text-lg font-semibold">{{ $item->judul_foto }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p>Tidak ada foto.</p>
                        @endforelse
                    </div>
                </div>
                <div class="hidden p-4 bg-white rounded-lg md:p-8" id="album" role="tabpanel" aria-labelledby="album-tab">
                    <!-- Container card Album -->
                    <div class="grid grid-cols-5 gap-4">
                        <!-- Memanggil data album -->
                        @foreach ($album as $index => $item)
                        <!-- Memanggil foto terbaru untuk cover album -->
                        @php
                            $fotoAlbum = $item->foto()->latest()->first();
                        @endphp
                        <!-- Card album -->
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                            <a href="{{ route('album.index', $item->id) }}">
                                @if ($fotoAlbum)
                                    <img class="rounded-t-lg object-cover w-full h-60" src="{{ url('storage/' . $fotoAlbum->lokasi_file) }}" alt="" />
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
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
