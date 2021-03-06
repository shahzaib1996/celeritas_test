<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostCommentRequest;
use App\Models\PostCategory;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'My Posts';
        $data['items'] = Post::all();
        return view('post.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create', $this->arrangeRequestData() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->input());
        if ($request->hasFile('images')) {
            $post->uploadImages($request->file('images'));
        }
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data['post'] = Post::where('slug',$slug)->with(['comments.user'])->firstOrFail();
        return view('post.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('post.create', $this->arrangeRequestData( decrypt($id) ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $item = Post::findOrFail($id);
        $item->update($request->input());
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
    }

    private function arrangeRequestData($id=null){
        $data['categories'] = PostCategory::where('status',PostCategory::STATUS_ACTIVE)->get();
        if( $id ){
            $data['item'] = Post::findOrFail($id);
            $data['title'] = 'Update Post';
            $data['action'] = route('post.update',['post'=>$id]);
        } else {
            $data['item'] = null;
            $data['title'] = 'Add Post';
            $data['action'] = route('post.store');
        }
        return $data;
    }

    public function comment(PostCommentRequest $request,$id){
        $post = Post::findOrFail( $id );
        $post->comments()->create($request->input());
        return back();
    }

}
