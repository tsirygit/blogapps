<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'likes',])
            ->withCount(['likes', 'comments'])
            ->get();

        foreach ($posts as $post) {
            $post->isLiked = $post->likes()->where('user_id', Auth::id())->exists();
        }

        return Inertia::render('Homepage', [
            'posts' => $posts,
        ]);
    }
}
