<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = 'Posts';
        $data['posts'] = Post::where('status',Post::STATUS_ACTIVE)->get();
        $data['categories'] = PostCategory::where('status',PostCategory::STATUS_ACTIVE)->get();
        return view('home',$data);
    }
}
