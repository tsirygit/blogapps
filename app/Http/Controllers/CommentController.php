<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    use AuthorizesRequests;


    public function create(Post $post)
    {


        if (!Auth::check()) {

            abort(403, 'Accès refusé');
        }

        return Inertia::render('Comments/Create', [
            'post' => $post,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
            'content' => 'required|string',
        ]);


        $validated['user_id'] = Auth::id();


        $comment = Comment::create($validated);


        return redirect()->route('post.show', $comment->post_id)->with('success', 'Vous commenter le publication avec succès.');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('edit', $comment);

        return Inertia::render('Comments/Edit', [
            'comment' => $comment
        ]);
    }

    public function update(Request $request, Comment $comment)
    {

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $this->authorize('update', $comment);


        $comment->update($validated);

        // return redirect()->route('post.show')->with('success', 'Votre commentaire a été changer avec avec succès.');

        return redirect()->route('post.show', $comment->post_id)->with('success', 'Votre commentaire a été changé avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('destroy', $comment);

        $comment->delete();

        return redirect()->route('post.show', $comment->post_id)->with('success', 'Votre commentaire a été supprimer  avec avec succès.');
    }
}
