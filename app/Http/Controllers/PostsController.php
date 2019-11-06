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
        $posts = App\Posts::all();
        return view('posts', compact('posts'));
    }
}

