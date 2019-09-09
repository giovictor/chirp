<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'post' => 'required|string|max:200',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $post = Post::create(['post' => $request->post, 'user_id' =>  $request->user_id]);
        return $post;
    }

    public function show($id)
    {
        
    }

    public function destroy(Post $post)
    {
        $post->delete();
    }
}
