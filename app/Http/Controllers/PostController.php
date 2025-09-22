<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {

            abort(403, 'Accès refusé');
        }

        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg,gif|max:2048',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);


        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
        }

        $validated['image'] = $path;
        $validated['user_id'] = Auth::id();


        Post::create($validated);


        return redirect()->route('homepage')->with('success', 'Votre post a été publié avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        $post->load(['comments.user', 'likes','user']);
        $post->loadCount(['likes', 'comments']);
        $post->isLiked = $post->likes()->where('user_id', Auth::id())->exists();

        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg,gif|max:2048',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);



        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }


        $post->update($validated);

        return redirect()->route('homepage')->with('success', 'Votre post a été changer avec avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('homepage')->with('success', 'Votre post a été supprimer  avec avec succès.');
    }

    public function ajaxLike(Request $request)
    {

        $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
            'like' => 'nullable|boolean',
        ]);

        $user = auth()->user();

        $postId = $request->post_id;

        $like = $request->like;

        $likeDislike = $user->LikeDislike($postId, $like);

        return redirect()->route('homepage')->with('status', $likeDislike);
    }
}
