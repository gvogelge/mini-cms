<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('posts.create');
    }


    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('image')?->store('images', 'public');

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->image_path = $path;
        $post->user_id = auth()->id();
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Beitrag erstellt');
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        $this->authorizeAction($post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $this->authorizeAction($post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->file('image')) {
            $path = $request->file('image')->store('images', 'public');
            $post->image_path = $path;
        }

        $post->update($validated);

        return redirect()->route('posts.edit', $post)->with('success', 'Beitrag aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $this->authorizeAction($post);
        $post->delete();
        return redirect()->route('home')->with('success', 'Beitrag gelöscht');
    }

    /**
     * Summary of authorizeAction
     * @param \App\Models\Post $post
     * @return void
     */
    protected function authorizeAction(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
