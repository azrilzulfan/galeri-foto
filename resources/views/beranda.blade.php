<x-app-layout>
    <div class="w-full mx-auto">
        <div class="text-2xl font-semibold mb-5">
            Terbaru
            <hr class="w-48 h-1 my-4 bg-purple-700 border-0 rounded">
        </div>
        <!-- Card Foto -->
        <div class="columns-6 max-w-full gap-4 my-0 mx-auto">
            <!-- Memanggil data foto terbaru -->
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
                <p>No photos available.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
