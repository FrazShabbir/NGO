<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class HomeController extends Controller
{
    public function index(){
        $slug  = str_replace(' ', '-', 'this is a mess');

        $posts = Post::orderBy('id', 'DESC')->get();
        dd($posts);
    }
}
