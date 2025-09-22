<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table of Posts</title>
</head>
<body>
    <h1>Table of Posts</h1>

    <!-- Link Tambah Post -->
    <p>
        <a href="{{ route('newposts.create') }}">Tambah Post</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($newposts as $post)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>
                    <!-- Tombol Lihat -->
                    <a href="{{ route('newposts.show', $post->id) }}">Lihat</a>

                    <!-- Tombol Edit -->
                    <a href="{{ route('newposts.edit', $post->id) }}" >Edit</a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('newposts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin hapus?')" >Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" align="center">No Post Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
