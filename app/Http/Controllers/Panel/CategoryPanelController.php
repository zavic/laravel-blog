<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('pages.panel.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.panel.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'color' => 'required|string|max:20',
            ]);

            // Slug
            $slug = Str::slug($validatedData['name']);
            $originalSlug = $slug;
            $categoryCount = Category::where('slug', 'like', "$slug%")->count();

            if ($categoryCount > 0) {
                $slug = $originalSlug . "-" . ($categoryCount + 1);
            }

            Category::create([
                'name' => $validatedData['name'],
                'slug' => $slug,
                'color' => $validatedData['color'],
            ]);

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('failed', 'Failed to create category: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('pages.panel.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'color' => 'required|string|max:20',
        ]);

        // Slug
        $slug = Str::slug($validatedData['name']);
        if ($slug !== $category->slug) {
            $originalSlug = $slug;
            $categoryCount = Category::where('slug', 'like', "$slug%")->count();

            if ($categoryCount > 0) {
                $slug = "{$originalSlug}-" . ($categoryCount + 1);
            }
        }

        // Update Category
        $category->update([
            'slug' => $slug,
            'name' => $validatedData['name'],
            'color' => $validatedData['color'],
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }


    public function search(Request $request)
    {
        $query = $request->query('query');
        $categories = Category::where('name', 'LIKE', "%$query%")->get(['id', 'name']);

        return response()->json($categories);
    }
}
