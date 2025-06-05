<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $path = null;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
            }

            Post::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'image_path' => $path,
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('home')->with('success', 'Beitrag erstellt.');
        } catch (\Exception $e) {
            return back()->withErrors(['image' => 'Bild konnte nicht gespeichert werden.'])->withInput();
        }
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($post->image_path) {
                    Storage::disk('public')->delete($post->image_path);
                }

                $path = $request->file('image')->store('images', 'public');
                $post->image_path = $path;
            }

            $post->title = $validated['title'];
            $post->content = $validated['content'];
            $post->save();

            return redirect()->route('posts.edit', $post)->with('success', 'Beitrag aktualisiert.');
        } catch (\Exception $e) {
            return back()->withErrors(['image' => 'Fehler beim Speichern des Bildes.'])->withInput();
        }
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
