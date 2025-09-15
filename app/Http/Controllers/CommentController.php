<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Post $post)
    {

        
        if (!Auth::check()) {

            abort(403, 'Accès refusé');
        }

        return Inertia::render('Comments/Create',[
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


        Comment::create($validated);


        return redirect()->route('homepage')->with('success', 'Vous commenter le publication avec succès.');
    }

}
