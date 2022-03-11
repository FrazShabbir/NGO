<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        dd($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'slug'=>'required|string|unique:posts',
            'body'=>'required',
            'amount'=>'nullable|string',
            'image'=>'nullable|mimes:png',
            'location'=>'required|string',
            ]);
        $slug  = str_replace(' ', '-', $request->slug);

        $post = Post::create([
            'title'=>$request->title,
            'slug'=>$slug,
            'body'=>$request->body,
            'amount'=>$request->amount,
            'location'=>$request->location,
        ]);
        return redirect()->route('post.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('slug', $id)->firstOrFail();
        dd($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('slug', $id)->firstOrFail();
        dd($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('slug', $id)->firstOrFail();
        $slug  = str_replace(' ', '-', $request->slug);

        if ($post->slug == $slug) {
            $request->validate([
                'title'=>'required|string',
                'slug'=>'required|string',
                'body'=>'required',
                'amount'=>'nullable|string',
                'image'=>'nullable|mimes:png',
                'location'=>'required|string',
                ]);
        } else {
            $request->validate([
                'title'=>'required|string',
                'slug'=>'required|string|unique:posts',
                'body'=>'required',
                'amount'=>'nullable|string',
                'image'=>'nullable|mimes:png',
                'location'=>'required|string',
                ]);
        }
        $post->title = $request->title;
        $post->slug = $slug;
        $post->body = $request->body;
        $post->amount = $request->amount;
        $post->location = $request->location;
        $post->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('slug', $id)->firstOrFail();
        $post->delete();
        return redirect()->route('post.index');
    }
}
