<?php

namespace App\Http\Controllers;

use App\Models\Post;

class IndexController extends Controller
{
    public function test()
    {
        $text = "";
        $posts = Post::all();
        foreach($posts as $post) {
            $text .= "userId: $post->userId, postText: $post->postText, int_prop: $post->int_prop </br>";
        }

        return $text;
    }
}
