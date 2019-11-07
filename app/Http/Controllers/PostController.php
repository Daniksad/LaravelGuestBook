<?php

namespace App\Http\Controllers;

use App;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
    * Show posts.
    *
    * @return View
    */
    public function index()
    {
        if (auth()->check())
            $logged = 1;
        else
            $logged = 0;

        $posts = Post::orderByDesc('created_at')->get();
        return view('posts', ['posts' => $posts, 'logged' =>  $logged]);
    }

    public function add(Request $request) {
        $data = $request->get('data');

        return Post::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'content' => $data['content'],
            'status' => 0
        ]);
    }
}

