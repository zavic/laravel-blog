<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardPanelController extends Controller
{
    public function index() 
    {
        $post = Post::count();
        $published = Post::where('published_at', '<', Carbon::now())->count();
        $visitor = Post::sum('views');
        // dd();
        return view('pages.panel.dashboard', compact('post', 'published', 'visitor'));
    }
}
