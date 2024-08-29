<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('categories')->get();
        return view('pages.panel.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.panel.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            // Validate
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required',
                'visibility' => 'required|in:public,private,unlisted',
                'image' => 'required',
                'categories' => 'array',
                'published_at' => 'nullable|date',
            ]);

            // Slug
            $slug = Str::slug($validatedData['title']);
            $originalSlug = $slug;
            $postCount = Post::where('slug', 'like', "$slug%")->count();

            if ($postCount > 0) {
                $slug = $originalSlug . "-" . ($postCount + 1);
            }

            // Published At
            if ($validatedData['published_at'] === null) {
                $published_at = $request->input('action') === 'publish_now' ? Carbon::now() : null;
            } else {
                $published_at = $request->input('action') === 'publish_now' ? Carbon::now() : $validatedData['published_at'];
            }

            // is_checked
            if (!$request->is_checked) {
                $published_at = null;
            }

            // Insert Category
            // $categories = $request->input('categories');
            // if (is_string($categories)) {
            //     // Decode categories if they are sent as a JSON string
            //     $categories = json_decode($categories, true);
            //     $request->merge(['categories' => $categories]);
            // }

            // $categories = [];
            // if ($request->categories !== null) {
            //     foreach ($request->categories as $category) {
            //         if (isset($category['isNew']) && $category['isNew']) {
            //             // Create new category if it doesn't exist
            //             $newCategory = Category::create([
            //                 'name' => $category['name'],
            //                 'slug' => Str::slug($category['name']),
            //             ]);
            //             $categories[] = $newCategory->id;
            //         } else {
            //             $categories[] = $category['id'];
            //         }
            //     }
            // }

            // Add New Post 
            $post = Post::create([
                'slug' => $slug,
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'visibility' => $validatedData['visibility'],
                'published_at' => $published_at ?? null,
            ]);

            // Add Media
            $post
                ->addMediaFromRequest('image')
                ->toMediaCollection();

            // Attach categories to post
            $post->categories()->attach($validatedData['categories']);

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'Failed to create post: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return redirect()->route('posts.index');
        // return view('pages.panel.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        $selectedCategories = $post->categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'isNew' => false,
            ];
        });

        return view('pages.panel.posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // dd($request);
        try {
            // Validate the request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required',
                'visibility' => 'required|in:public,private,unlisted',
                'image' => 'required',
                'published_at' => 'nullable|date',
            ]);

            // Slug
            $slug = Str::slug($validatedData['title']);
            if ($slug !== $post->slug) {
                $originalSlug = $slug;
                $postCount = Post::where('slug', 'like', "$slug%")->count();

                if ($postCount > 0) {
                    $slug = "{$originalSlug}-" . ($postCount + 1);
                }
            }

            // Published At
            if ($request->input('action') === 'publish_now') {
                $published_at = Carbon::now();
            } else {
                $published_at = $request->published_at;
            }
            // if ($validatedData['published_at'] === null) {
            //     $published_at = $request->input('action') === 'publish_now' ? Carbon::now() : null;
            // } else {
            //     $published_at = $request->input('action') === 'publish_now' ? Carbon::now() : $validatedData['published_at'];
            // }

            // is_checked
            if (!$request->is_checked && $request->input('action') !== 'publish_now') {
                $published_at = null;
            }

            // Categories
            $categories = $request->input('categories');
            if (is_string($categories)) {
                // Decode categories if they are sent as a JSON string
                $categories = json_decode($categories, true);
                $request->merge(['categories' => $categories]);
            }

            $categories = [];
            if ($request->categories !== null) {
                foreach ($request->categories as $category) {
                    if (isset($category['isNew']) && $category['isNew']) {
                        // Create new category if it doesn't exist
                        $newCategory = Category::create([
                            'name' => $category['name'],
                            'slug' => Str::slug($category['name']),
                        ]);
                        $categories[] = $newCategory->id;
                    } else {
                        $categories[] = $category['id'];
                    }
                }
            }

            // Update post
            $post->update([
                'slug' => $slug,
                'title' => $validatedData['title'],
                'body' => $validatedData['body'],
                'visibility' => $validatedData['visibility'],
                'published_at' => $published_at,
            ]);

            // Sync categories without duplication
            $post->categories()->sync($categories);


            return redirect()->route('posts.edit', $post)->with('success', 'Post updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('failed', 'Failed to update post: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    /**
     * Autosave with Alpine JS
     */
    public function autosave(Request $request)
    {
        Post::updateOrCreate(
            ['id' => $request->id],
            [
                'slug' => $request->slug,
                'title' =>  $request->title,
                'body' =>  $request->body
            ]
        );

        return response()->json(['message' => 'Draft saved successfully']);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.index')->with('success', 'Post restored successfully.');
    }

    /**
     * Force Delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->route('posts.index')->with('success', 'Post permanently deleted.');
    }
}
