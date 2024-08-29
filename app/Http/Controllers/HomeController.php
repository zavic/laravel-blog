<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::with(['posts' => function ($query) {
            $query->take(4);
        }])->get();

        $posts = Post::paginate(8);

        return view('pages.home', compact('posts', 'categories'));
    }
}
