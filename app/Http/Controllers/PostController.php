<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all();
        foreach($posts as $key => $post) {
            $post->setAttribute('user', $post->user);
            $post->setAttribute('likes', $post->likes);
        }

        return Inertia::render('Posts', [
            'posts' => $posts
        ]);
    }

    public function store (Request $request)
    {
        $request->user()->posts()->create([
            'body' => $request->body,
        ]);

        return back();
    }

    public function destroy(Post $post)
    {
        if(!$this->authorize('delete', $post)) {
            return response(null, 409);
        }

        $post->delete();
        return back();
    }
}
