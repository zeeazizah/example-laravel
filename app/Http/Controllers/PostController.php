<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
	{

		// Showing entries
		$perPage = $request->input('entries', 5);

		// Base query
		if (Auth::check() && Auth::user()->role == 1) {
			// Admin: lihat semua post
			$query = Post::with('user');
		}
		else if (Auth::check()) {
			// User biasa: hanya post miliknya
			$query = Post::with('user')
				->where('user_id', Auth::id());
		}
		else {
			// Guest: hanya post publish
			$query = Post::with('user')
				->where('is_publish', true);
		}

		$query->when($request->filled('search'), function ($q) use ($request) {
			$search = $request->search;

			$q->where(function ($query) use ($search) {
				$query->where('title', 'like', "%{$search}%")
					->orWhereHas('user', function ($user) use ($search) {
						$user->where('name', 'like', "%{$search}%");
					});
			});
		});

		// Pagination (admin & user: 5, guest: 9)
		$perPage = $request->input('entries', (Auth::check() && Auth::user()->role == 1) || (Auth::check()) ? 5 : 9);

		$posts = $query->latest()->paginate($perPage);

		return view('posts.index', [
			'posts'   => $posts,
			'search'  => $request->search,
			'entries' => $perPage,
		]);
	}


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
		$validated = $request->validate([
		'title'        => 'required|string|max:255',
		'content'      => 'required|string',
		'publish_date' => 'required|date',
		'image'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
		], [
			// Judul
			'title.required' => 'Judul post wajib diisi.',
			'title.string'   => 'Judul post harus berupa teks.',
			'title.max'      => 'Judul post tidak boleh lebih dari 255 karakter.',

			// Konten
			'content.required' => 'Konten post wajib diisi.',
			'content.string'   => 'Konten post harus berupa teks.',

			// Tanggal Publish
			'publish_date.required' => 'Tanggal publish wajib diisi.',
			'publish_date.date'     => 'Tanggal publish harus berupa format tanggal yang valid.',

			// Gambar
			'image.required' => 'Gambar post wajib diunggah.',
			'image.image'    => 'File yang diunggah harus berupa gambar.',
			'image.mimes'    => 'Format gambar harus jpg, jpeg, atau png.',
			'image.max'      => 'Ukuran gambar tidak boleh lebih dari 2MB.',
		]);


        $photoName = null;
        if ($request->hasFile('image')) {
            $photoName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $photoName);
        }

        $isPublish = $request->input('action') === 'publish';

        Post::create([
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'publish_date' => $validated['publish_date'],
            'is_publish'   => $isPublish,
            'image'        => $photoName,
            'user_id'      => Auth::id(),
        ]);

        return redirect()
            ->route('posts.index')
            ->with('success', $isPublish ? 'Post berhasil dipublish' : 'Post disimpan sebagai draft');
    }

    public function show(Post $post)
    {
        // Hanya admin atau pemilik yang boleh akses jika post masih draft
        if (!$post->is_publish && ((Auth::id() !== $post->user_id && Auth::user()->role != 1))) {
            abort(403, 'Anda tidak memiliki akses untuk melihat post ini.');
        }

        return view('posts.show', [
			'post' => $post,
		]);
    }

    public function edit(Post $post)
    {
        // Hanya pemilik post atau admin yang bisa edit
        if (Auth::id() !== $post->user_id && Auth::user()->role != 1) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit post ini.');
        }

        return view('posts.edit', [
			'post' => $post,
		]);
    }

    public function update(Request $request, Post $post)
    {
        // Hanya pemilik post atau admin yang bisa update
        if (Auth::id() !== $post->user_id && Auth::user()->role != 1) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah post ini.');
        }

        $validated = $request->validate([
		'title'        => 'required|string|max:255',
		'content'      => 'required|string',
		'publish_date' => 'required|date',
		'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
		], [
			// Judul
			'title.required' => 'Judul post wajib diisi.',
			'title.string'   => 'Judul post harus berupa teks.',
			'title.max'      => 'Judul post tidak boleh lebih dari 255 karakter.',

			// Konten
			'content.required' => 'Konten post wajib diisi.',
			'content.string'   => 'Konten post harus berupa teks.',

			// Tanggal Publish
			'publish_date.required' => 'Tanggal publish wajib diisi.',
			'publish_date.date'     => 'Tanggal publish harus berupa format tanggal yang valid.',

			// Gambar
			'image.image'    => 'File yang diunggah harus berupa gambar.',
			'image.mimes'    => 'Format gambar harus jpg, jpeg, atau png.',
			'image.max'      => 'Ukuran gambar tidak boleh lebih dari 2MB.',
		]);

       if ($request->hasFile('image')) {
			if (!empty($post->image)) {
				$oldImage = public_path('images/' . $post->image);
				if (file_exists($oldImage)) {
					unlink($oldImage);
				}
			}

			$photoName = time() . '.' . $request->image->extension();
			$request->image->move(public_path('images'), $photoName);
			$post->image = $photoName;
		}


        $isPublish = $request->input('action') === 'publish';

        $post->update([
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'publish_date' => $validated['publish_date'],
            'is_publish'   => $isPublish,
            'image'        => $post->image,
        ]);

        return redirect()
            ->route('posts.index')
            ->with('success', $isPublish ? 'Post berhasil dipublish' : 'Post disimpan sebagai draft');
    }

    public function destroy(Post $post)
    {
        // Hanya pemilik post atau admin yang bisa hapus
        if (Auth::id() !== $post->user_id && Auth::user()->role != 1) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus post ini.');
        }

        if ($post->image) {
            $oldImage = public_path('images/'.$post->image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus');
    }

	public function publicPosts(Request $request)
	{
		$query = Post::with('user')->where('is_publish', true);

		//Fitur Pencarian diselaraskan dengan index()
		$query->when($request->filled('search'), function ($q) use ($request) {
			$search = $request->search;

			$q->where(function ($query) use ($search) {
				$query->where('title', 'like', "%{$search}%")
					->orWhereHas('user', function ($user) use ($search) {
						$user->where('name', 'like', "%{$search}%");
					});
			});
		});

		$posts = $query->latest()->paginate(6);

		return view('public.posts.index', [
			'posts'  => $posts,
			'search' => $request->search, // agar input pencarian tetap muncul di form
		]);
	}

	public function publicShow($id)
	{
		$post = Post::with('user')->findOrFail($id);

		if (!$post->is_publish) {
			abort(404);
		}

		return view('public.posts.show', compact('post')); // bukan 'posts'
	}

}
