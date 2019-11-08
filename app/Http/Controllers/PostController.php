<?php

namespace App\Http\Controllers;

use App;
use App\Post;
use App\User;
use Auth;
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

    public function add(Request $request) {
        $data = $request->get('data');

        return Post::create([
            'parent_id' => $data['parent_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'content' => $data['content'],
            'status' => $data['status']
        ]);
    }

    public function changeStatus(Request $request) {
        if (auth()->check()) {
            $data = $request->get('data');

            return Post::where('id', $data['id'])
                ->update(['status' => $data['status']]);
        }
    }

    public function delete(Request $request) {
        if (auth()->check()) {
            $data = $request->get('data');

            Post::where('parent_id', $data['id'])
                ->delete();

            return Post::where('id', $data['id'])
                ->delete();
        }
    }
}

