<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = ["id"];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postToTag(){
        return $this->hasMany(PostToTag::class);
    }

    // Biar defaultnya ga id tapi slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
