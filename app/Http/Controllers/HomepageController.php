<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $posts = Post::with('likes') // Charge les commentaires et les likes
                 ->withCount(['likes', 'comments']) // Compte les likes et commentaires
                 ->get();

        foreach ($posts as $post) {
            $post->isLiked = $post->likes()->where('user_id', Auth::id())->exists();
        }

        return Inertia::render('Homepage', [
            'posts' => $posts,
        ]);
    }
}
