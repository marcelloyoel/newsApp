<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $judul = '';
        if (request('tag')) {
            $tag = Tag::firstWhere('slug', request('tag'));
            $judul = 'In: ' . $tag->name;
        }
        if (request('author')) {
            $user = User::firstWhere('name', request('author'));
            $judul = 'By: ' . $user->name;
        }
        return view('home',[
            'title' => 'Home Page',
            'posts' => Post::latest()->filter(request(['search', 'tag', 'author']))->active()->paginate(6)->withQueryString(),
            'active'    => 'home',
            'judul'     => $judul,
            'tags'      => Tag::all(),
        ]);
    }

    public function show(Post $post)
    {
        $postToTags = $post->postToTag;
        $genres = [];

        foreach ($postToTags as $postToTag) {
            $genresNih = $postToTag->tag->name;
            $genres[] = $genresNih;
        }
        $genresString = implode(', ', $genres);

        return view('homeDetail', [
            "title" => "Single Post",
            "post" => $post,
            'active'    => 'home',
            'genre' => $genresString,
            'tags'      => Tag::all(),
        ]);
    }
}
