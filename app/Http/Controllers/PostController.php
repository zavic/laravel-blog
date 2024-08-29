<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['posts' => function ($query) {
            $query->take(4); // Ambil hanya 4 posting dari setiap kategori
        }])->get();

        // Ambil posting dengan paginasi
        $posts = Post::paginate(8);

        return view('pages.posts.index', compact('posts', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::last()->with('categories')->where('slug', $slug)->firstOrFail();

        $posts = Post::latest()->take(4)->get();

        $sessionKey = 'viewed_posts_' . $post->id;

        if (!session()->has($sessionKey)) {
            $post->increment('views');
            session()->put($sessionKey, true);
        }

        if (!$post->visibility) {
            abort(404);
        }

        return view('pages.posts.show', compact('post', 'posts'));
    }
}
