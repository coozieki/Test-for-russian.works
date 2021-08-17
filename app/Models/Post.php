<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'userId', 'user_id', 'postText', 'post_text'
    ];

    public $int_prop = 2;
}
