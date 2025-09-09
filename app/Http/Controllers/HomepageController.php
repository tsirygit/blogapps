<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index() {

        $post = Post::all();

        return Inertia::render('Homepage',[
            'post' => $post
        ]);
    }
}
