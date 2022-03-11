<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ApprovePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
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
        //
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
        //
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
                'status'=>'required|string',
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
        $post->status = $request->status;
        $post->featured = $request->featured;
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
        //
    }
}
