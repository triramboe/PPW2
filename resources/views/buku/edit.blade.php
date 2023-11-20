<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <!-- Bootstrap CSS Link (version 5) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Edit Buku</h1>
        <form method="POST" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku:</label>
                <input type="text" name="judul" id="judul" value="{{ $buku->judul }}" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis:</label>
                <input type="text" name="penulis" id="penulis" value="{{ $buku->penulis }}" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga:</label>
                <input type="number" name="harga" id="harga" value="{{ $buku->harga }}" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit:</label>
                <input type="date" name="tgl_terbit" id="tgl_terbit" value="{{ $buku->tgl_terbit->format('Y-m-d') }}" class="form-control" required>
            </div>

            <div class="my-5">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <div class="d-flex align-items-center">
                    @if($buku->filepath)
                    <img src="{{ asset($buku->filepath) }}" alt="Thumbnail" width="100" class="me-3">
                    @endif
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                </div>
            </div>

            <div class="col-span-full mt-6">
                <label for="gallery" class="block text-sm font-medium text-gray-600">Gallery</label>
                <div class="mt-1" id="fileinput_wrapper"></div>
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="text-blue-600 hover:underline">Tambah</a>
                <script type="text/javascript">
                    function addFileInput() {
                        var div = document.getElementById('fileinput_wrapper');
                        div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="form-control mb-5" style="margin-bottom:5px;">';
                    };
                </script>
            </div>

            <div class="my-5 flex items-center justify-end space-x-6">
                <a href="/buku" class="btn btn-warning">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>


        </form>

        <div class="gallery_items mt-6 space-x-4 flex flex-wrap">
            @foreach($buku->galleries()->get() as $gallery)
            <div class="gallery_item mb-4">
                <img class="object-cover object-center" src="{{ asset($gallery->path) }}" alt="" width="400">
                <form action="{{ route('buku.deleteImage', [$buku->id, $gallery->id]) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger mt-1 mb-1" onClick="return confirm('Yakin mau dihapus?')">Hapus</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JavaScript Link (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>