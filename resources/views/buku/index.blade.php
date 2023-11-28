<x-app-layout>
    <x-slot name="header">
        <h2>Daftar Buku</h2>
    </x-slot>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Buku</title>
        <!-- Tautan Bootstrap CSS versi 5 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            /* Menambahkan sedikit gaya CSS */
            body {
                background-color: #f8f9fa;
            }

            .container {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-top: 20px;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <div class="container">
        @if(Session::has('pesan'))
        <div class="alert alert-success">{{ session('pesan') }}</div>
        @endif
        <form action="{{ route('buku.search') }}" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" name="kata" class="form-control" placeholder="Cari buku...">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
            </div>
        </form>
        @if(Auth::check() && Auth::user()->level == 'admin')
        <a href="{{ route('buku.create')}}" class="btn btn-primary">Tambah Buku</a>
        @endif
        <!-- Tabel daftar buku -->
        <table class="table table-striped">
            <thead class="bg-light">
                <tr>
                    <th>ID</th>
                    <th>Thumbnail</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    @if(Auth::check() && Auth::user()->level == 'admin')
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                <tr>
                    <td><a href="{{ route('buku.show', $buku->id) }}">{{ $buku->id }}</a></td>
                    <td>
                        @if ( $buku->filepath )
                        <div class="relative h-10 w-10">
                            <img class="h-full w-full object-cover object-center" src="{{ asset($buku->filepath) }}" alt="" />
                        </div>
                        @endif
                    </td>
                    <td><a href="{{ route('buku.galeri', $buku->id) }}">{{ $buku->judul }}</a></td>
                    <td>{{ $buku->penulis }}</td>
                    <td>Rp {{ number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ $buku->tgl_terbit->format('Y-m-d') }}</td>
                    @if(Auth::check() && Auth::user()->level == 'admin')
                    <td>
                        <div class="btn-group" role="group" style="overflow-x: auto;">
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                            <form action="{{ route('buku.edit', $buku->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm ms-3">
                                    <i class="fas fa-pencil-alt"></i> Update
                                </button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $data_buku->links() }}</div>

        <p class="mt-3">Jumlah Data: {{ $jumlahData }}</p>
        <p>Total Harga: Rp {{ number_format($totalHarga, 2) }}</p>
    </div>

</x-app-layout>