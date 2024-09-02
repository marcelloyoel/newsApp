<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostToTag extends Model
{
    use HasFactory;


    public function post(){
        $this->belongsTo(Post::class);
    }

    public function tag(){
        $this->belongsTo(Tag::class);
    }
}
