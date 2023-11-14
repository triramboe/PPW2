<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <!-- Tautan Bootstrap CSS versi 5 -->
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

            <!-- <div class="col-span-full my-5">
                <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                <div class="mt-2">
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
            </div> -->

            <div class="col-span-full my-5">
                <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                <div class="mt-2">
                    @if($buku->filepath)
                    <img src="{{ asset($buku->filepath) }}" alt="Thumbnail" width="100" />
                    <input type="file" name="thumbnail" id="thumbnail">
                    @else
                    <input type="file" name="thumbnail" id="thumbnail">
                    @endif
                </div>
            </div>


            <div class="col-span-full my-5">
                <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper">

                </div>
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="btn btn-primary">Tambah</a>
                <script type="text/javascript">
                    function addFileInput() {
                        var div = document.getElementById('fileinput_wrapper');
                        div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                    };
                </script>
            </div>
            <div class="gallery_items my-5">
                @foreach($buku->galleries()->get() as $gallery)
                <div class="gallery_item">
                    <img class="rounded-full object-cover object-center" src="{{ asset($gallery->path) }}" alt="" width="400" />
                </div>
                @endforeach
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="/buku" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <!-- Tautan Bootstrap JavaScript (Jika diperlukan) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>