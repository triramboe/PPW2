<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Tambahkan tautan CSS Bootstrap di sini -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h4 class="mt-4">Tambah Buku</h4>
        @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form method="post" action="{{ route('buku.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-3">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="tgl_terbit">Tgl. Terbit</label>
                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" placeholder="Y-m-d" required>
            </div>


            <div class="my-4">
                <label for="thumbnail" class="block text-sm font-medium text-gray-600">Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-input mt-1 block w-full rounded-md">
            </div>

            <div class="col-span-full mt-6">
                <label for="gallery" class="block text-sm font-medium text-gray-600">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper"></div>
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="text-blue-600 hover:underline">Tambah</a>
                <script type="text/javascript">
                    function addFileInput() {
                        var div = document.getElementById('fileinput_wrapper');
                        div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="form-input block w-full rounded-md mb-5" style="margin-bottom:5px;">';
                    };
                </script>
            </div>

            <div class="my-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/buku" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <!-- Tambahkan tautan JavaScript Bootstrap di sini (jika diperlukan) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>