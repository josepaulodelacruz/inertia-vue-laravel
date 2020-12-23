<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show(User $user)
    {
        foreach ($user->posts as $key => $post) {
            $post->setAttribute('user', $post->user);
            $post->setAttribute('likes', $post->likes);
        }
        return Inertia::render('PostView', [
            'posts' => $user->posts,
            'user' => $user->setAttribute('total_likes', $user->receivedLikes()->count())
        ]);
    }
}
