<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App;
use SebastianBergmann\Environment\Console;

class PostsController extends Controller
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

        $posts = App\Posts::orderByDesc('created_at')->get();
        return view('posts', ['posts' => $posts, 'logged' =>  $logged]);
    }
}

