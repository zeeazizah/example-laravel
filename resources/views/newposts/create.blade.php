<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Post</title>
</head>
<body>
    <h1>Tambah Post</h1>

    <form action="{{ route('newposts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Field Judul -->
        <div>
            <label for="title">Judul:</label><br>
            <input type="text" id="title" name="title" required size="60">
        </div>
        <br>

        <!-- Field Isi -->
        <div>
            <label for="content">Isi:</label><br>
            <textarea id="content" name="content" rows="10" cols="60" required></textarea>
        </div>
        <br>

        <!-- Tombol Submit -->
        <div>
            <button type="submit" onclick="alert('Data Berhasil Ditambah')">Simpan</button>
			<a href="{{ route('newposts.index') }}">Batal</a>
        </div>
    </form>
</body>
</html>
