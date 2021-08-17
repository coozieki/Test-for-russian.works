<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class CamelCaseTest extends TestCase
{
    public function testCreate()
    {
        $text = 'qwerty123456';
        $post = Post::factory()->create([
            'postText' => $text
        ]);

        $this->assertEquals($post->postText, $text);
    }

    public function testSave()
    {
        $text = 'qwerty123456';
        $post = new Post([
            'userId' => User::factory()->create()->id,
            'postText' => $text
        ]);

        $post->save();

        $this->assertEquals($post->postText, $text);

        $text = '333qwerty123456asdf';

        $post = new Post();
        $post->userId = User::factory()->create()->id;
        $post->postText = $text;
        $post->save();

        $this->assertEquals($post->postText, $text);
    }

    public function testUpdate()
    {
        $text = 'qwerty123456';
        $post = Post::factory()->create([
            'postText' => $text
        ]);

        $text = '333qwerty123456asdf';
        $post->update([
            'postText' => $text
        ]);
        $post->fresh();

        $this->assertEquals($post->postText, $text);
    }
}
