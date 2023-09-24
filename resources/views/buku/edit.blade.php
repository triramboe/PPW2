<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* Gaya untuk judul halaman */
    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    /* Gaya untuk form dan elemen form */
    form {
        max-width: 400px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Gaya untuk tombol "Simpan Perubahan" */
    button[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Hover state untuk tombol */
    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<h1>Edit Buku</h1>

<form method="POST" action="{{ route('buku.update', $buku->id) }}" >
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="judul">Judul Buku:</label>
        <input type="text" name="judul" id="judul" value="{{ $buku->judul }}" required class="form-control">
    </div>

    <div class="form-group">
        <label for="penulis">Penulis:</label>
        <input type="text" name="penulis" id="penulis" value="{{ $buku->penulis }}" required class="form-control">
    </div>

    <div class="form-group">
        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" value="{{ $buku->harga }}" required class="form-control">
    </div>

    <div class="form-group">
        <label for="tgl_terbit">Tanggal Terbit:</label>
        <input type="date" name="tgl_terbit" id="tgl_terbit" value="{{ $buku->tgl_terbit }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
</body>
</html>