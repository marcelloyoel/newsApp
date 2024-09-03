<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostToTag;
use App\Models\Tag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('author.author',[
            'title' => 'Author Dashboard',
            'posts' => Post::where('user_id', '=', auth()->user()->id)
                        ->where('status', '=', true)
                        ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.newPost',[
            'title' => 'Create Post',
            'javascript'   => 'createpost.js',
            'tags'  => Tag::all(),
            'trix'  => 'ada'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug'  => 'required',
            'excerpt'   => 'max:100',
            'content'   => 'required'
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        if (empty($validatedData['excerpt'])) {
            $validatedData['excerpt'] = Str::limit(strip_tags($request->content), 100, '...');
        }
        DB::beginTransaction();
        try {
            $post = Post::create($validatedData);
            foreach ($request->selectMultipleStatus as $value) {
                PostToTag::create([
                    'post_id' => $post->id,
                    'tag_id' => $value
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error creating post or post-to-tag: ' . $th->getMessage());
            return redirect()->back()->with('error', 'There was an error adding the post.');
        }
        return redirect('/posts')->with('success', 'Data berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $postToTags = $post->postToTag;
        // dd($postToTags);
        $genres = [];

        foreach ($postToTags as $postToTag) {
            // Access the related Service and get the serviceName attribute
            $genresNih = $postToTag->tag->name;

            // Add the serviceName to the array
            $genres[] = $genresNih;
        }
        // dd($genres);
        $genresString = implode(', ', $genres);
        $formattedDate = \Carbon\Carbon::parse($post->created_at)->format('l, d F Y');
        return view('author.detailPost', [
            'title' => 'View Post',
            'post'  => $post,
            'genres'    => $genresString,
            'tanggal'   => $formattedDate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $postToTags = $post->postToTag;
        $genres = [];

        foreach ($postToTags as $postToTag) {
            $genresNih = $postToTag->tag->id;
            $genres[] = $genresNih;
        }
        // dd($genres);
        return view('author.edit', [
            'title' => 'Edit Post',
            'post'  => $post,
            'tags'  => Tag::all(),
            'selectedTags'  => $genres,
            'trix'  => 'ada'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'excerpt'   => 'max:100',
            'content'   => 'required'
        ];
        if($post->slug != $request->slug){
            $rules['slug']  = 'required|unique:posts';
        }
        $validatedData =  $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;
        if (empty($validatedData['excerpt'])) {
            $validatedData['excerpt'] = Str::limit(strip_tags($request->content), 100, '...');
        }

        DB::beginTransaction();
        try {
            $post->update($validatedData);
            PostToTag::where('post_id', $post->id)->delete();
            foreach ($request->selectMultipleStatus as $value) {
                PostToTag::create([
                    'post_id' => $post->id,
                    'tag_id' => $value
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error creating post or post-to-tag: ' . $th->getMessage());
            return redirect()->back()->with('error', 'There was an error adding the post.');
        }
        return redirect('/posts')->with('update', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->update(['status' => false]);
        return redirect('/posts')->with('delete', 'Data berhasil dihapus!');
    }

    public function createSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
