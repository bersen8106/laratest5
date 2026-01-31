<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::latest()->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|min:5',
            'slug' => 'nullable',
            'excerpt' => 'required|min:10',
            'body' => 'required|min:10',
            'is_published' => 'nullable',
            'published_at' => 'nullable',
            'user_id' => 'nullable',
        ]);

        $slugBase = Str::slug($data['title']);  // создает человекочитаемый URL
        $slug = $slugBase . '-' . rand(1, 999999);  // гарантирует уникальность $slug
        $data['slug'] = $slug;

        $data['is_published'] = $request->has('is_published') == 'on';
        $data['published_at'] = $request->has('is_published') ? now() : null;

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|min:5',
            'excerpt' => 'required|min:10',
            'body' => 'required|min:10',
            'is_published' => 'nullable',
            'published_at' => 'nullable',
            'user_id' => 'nullable',
        ]);

        $data['is_published'] = $request->has('is_published') == 'on';
        $data['published_at'] = $request->has('is_published') ? now() : null;

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
