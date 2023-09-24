<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <style>
        /* Gaya untuk baris tabel */
        tr {
            border-bottom: 1px solid #ccc;
        }

        /* Gaya untuk sel header tabel */
        th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 10px;
        }

        /* Gaya untuk sel data dalam tabel */
        td {
            padding: 10px;
        }

        /* Gaya untuk tombol Hapus */
        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 2px 2px;
            cursor: pointer;
        }

        /* Gaya untuk tombol Update */
        .update-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 2px 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <th>id</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tgl. Terbit</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach($data_buku as $buku)
            <tr>
                <td>{{ $buku->id }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp ".number_format($buku->harga, 2, ',','.') }}</td>
                <td>
                    @if ($buku->tgl_terbit)
                        {{ $buku->tgl_terbit->format('m/d/Y') }}
                    @else
                        Tidak Ada Tanggal Terbit
                    @endif
                </td>
                <td>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="delete-button" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
                    </form>
                    <form action="{{ route('buku.edit', $buku->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button class="update-button" onclick="return confirm('Yakin mau diupdate?')">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Jumlah Data: {{ $jumlahData }}</p>
    <p>Total Harga: Rp {{ number_format($totalHarga, 2) }}</p>
    <p style="align-items: center;"><a href="{{ route('buku.create') }}">Tambah Buku</a></p>
</body>
</html>
