<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>

    <form action="{{ route('newposts.update', $newpost->id) }}" method="POST">
        @csrf
        @method('PUT')

        <table cellpadding="6">
            <tr>
                <td><label for="title">Title:</label></td>
                <td><input type="text" id="title" name="title" value="{{ $newpost->title }}" size="60"></td>
            </tr>

            <tr>
                <td><label for="content">Content:</label></td>
                <td>
                    <textarea id="content" name="content" rows="10" cols="60">{{ $newpost->content }}</textarea>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit">Update</button>
                    <a href="{{ route('newposts.index') }}">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
