<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Post</title>
</head>
<body>
    <h1>Detail Post</h1>

    <div>
        <p><strong>ID:</strong> {{ $newpost->id }}</p>
        <p><strong>Title:</strong> {{ $newpost->title }}</p>
        <p><strong>Content:</strong></p>
        <p>{{ $newpost->content }}</p>
    </div>

    <div>
        <a href="{{ route('newposts.index') }}">Kembali</a> |
        <a href="{{ route('newposts.edit', $newpost->id) }}">Edit Post</a>
    </div>
</body>
</html>
