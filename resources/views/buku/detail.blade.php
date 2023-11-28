<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold">Detail Buku</h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        <div class="max-w-2xl mx-auto bg-white rounded-md overflow-hidden shadow-md">
            <div class="p-6">
                <h5 class="text-xl font-semibold mb-4 text-center">{{ $buku->judul }}</h5>
                <p class="text-gray-600 mb-2">Penulis: {{ $buku->penulis }}</p>
                <p class="text-gray-600 mb-2">Harga: Rp {{ number_format($buku->harga, 2, ',', '.') }}</p>
                <p class="text-gray-600 mb-2">Tanggal Terbit: {{ $buku->tgl_terbit->format('Y-m-d') }}</p>

                @if ($buku->filepath)
                <img src="{{ asset($buku->filepath) }}" alt="Thumbnail" class="w-full h-auto mb-4">
                @endif


                <!-- Rating Section -->
                <div class="my-5">
                    <h3 class="text-xl font-semibold mb-2">Rating</h3>
                    @if ($averageRating !== null)
                    <p class="text-gray-600">Average Rating: {{ number_format($averageRating, 2) }}</p>
                    @else
                    <p class="text-red-600">Rating is not available.</p>
                    @endif


                    <form action="{{ route('buku.rate', $buku->id) }}" method="post">
                        @csrf
                        <div>
                            <div>
                                <input type="text" name="rating" id="rating" class="my-1 p-2 border rounded-md w-full" placeholder="Enter rating value">
                            </div>

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit Rating</button>
                        </div>
                    </form>
                    <div class="mt-6 text-right">
                        <a href="/buku" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Kembali ke Daftar Buku</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>