<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->parent_id = $request['parent_id'];
        $post->name = $request['name'];
        $post->email = $request['email'];
        $post->content = $request['content'];
        $post->status = $request['status'];
        $post->save();

        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post = Post::findOrFail($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post = Post::findOrFail($post);
        $post->fill($request->except(['id']));
        $post->save();
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post);
        if($post->delete()) return response(null, 204);
    }
}
