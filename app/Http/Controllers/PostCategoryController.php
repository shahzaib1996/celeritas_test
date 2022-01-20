<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostCategoryRequest;
use App\Models\PostCategory;
use App\Models\Post;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Category';
        $data['items'] = PostCategory::where('status',PostCategory::STATUS_ACTIVE)->get();
        return view('category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create', $this->arrangeRequestData() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request)
    {
        PostCategory::create($request->input());
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('category.create', $this->arrangeRequestData( decrypt($id) ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, $id)
    {
        $item = PostCategory::findOrFail($id);
        $item->update($request->input());
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PostCategory::where('id', decrypt($id) )->delete();
        return redirect()->route('category.index');
    }

    private function arrangeRequestData($id=null){
        if( $id ){
            $data['item'] = PostCategory::findOrFail($id);
            $data['title'] = 'Update Category';
            $data['action'] = route('category.update',['category'=>$id]);
        } else {
            $data['item'] = null;
            $data['title'] = 'Add Category';
            $data['action'] = route('category.store');
        }
        return $data;
    }

    public function showPosts($id){
        $category = PostCategory::findOrFail( decrypt($id) );
        $data['posts'] = Post::where('category_id',decrypt($id))->where('status',Post::STATUS_ACTIVE)->get();
        $data['title'] = $category->name.' Posts';
        return view('home',$data);
    }

}
