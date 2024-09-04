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

    public function scopeActive($query){
        return $query->where('status', true);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['tag'] ?? false, function ($query, $tag) {
            return $query->whereHas('postToTag.tag', function ($query) use ($tag) {
                $query->where('slug', $tag);
            });
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
            //bakal return pake whereHas dengan parameter relational-nya. Disini ada category dan author
            return $query->whereHas('user', function ($query) use ($author) {
                $query->where('name', $author);
            });
        });
    }
}
