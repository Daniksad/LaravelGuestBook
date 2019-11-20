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
        return view('posts', ['logged' => 1, 'user' => json_encode(['name' => 'Anonymous', 'email' => 'none'])]);
    }
}
