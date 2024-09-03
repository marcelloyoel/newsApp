<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostToTag extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'tag_id'];
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
