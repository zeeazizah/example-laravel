<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>Table of Post</h1>
	<a href="{{ route('posts.create') }}">Tambah Post</a>
	<table>
		<tr>
			<th>Nomor</th>
			<th>Judul</th>
			<th>Isi</th>
			<th>Tanggal Terbit</th>
			<th>Gambar</th>
			<th>Penulis</th>
		</tr>
			@forelse ($posts as $post)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $post->title }}</td>
				<td>{{ $post->content }}</td>
				<td>{{ $post->published_at }}</td>
				<td>
					@if ($post->image)
						<img src="{{ asset('storage/' . $post->image) }}" alt="" width="150px">
					@else
						No Image
					@endif
				</td>
				<td>{{ $post->user->name }}</td>
			</tr>
			@empty
				<tr>
					<td colspan="6">No Post Found</td>
				</tr>
			@endforelse
	</table>
</body>
</html>