<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /**
     * Show posts.
     *
     * @return View
     */
    public function index()
    {
        auth()->check() ? $logged = 1 : $logged = 0;

        if (auth()->check()) {
            $user = User::where('id', Auth::user()->id)->get();
            $posts = Post::orderByDesc('created_at')->get();
        }
        else {
            $user = json_encode(['name' => 'Anonymous', 'email' => 'none']);
            $posts = Post::where('status', 1)->orderByDesc('created_at')->get();
        }

        return view('posts', ['posts' => $posts, 'logged' => $logged, 'user' => $user]);
    }
}
