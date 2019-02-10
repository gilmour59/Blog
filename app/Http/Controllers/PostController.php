<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if($categories->count() === 0){
            return redirect()->route('home')->with('error', 'Please have atleast one Category.');
        }
        return view('admin.posts.create')->with('categories', $categories);
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
            'title' => 'required|max:255', //nullable|max:255|regex:/^[a-zA-Z]+$/u
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $featured = $request->file('featured');
        $featured_new_name = time() . $featured->getClientOriginalName();
        $featured->move('uploads/posts', $featured_new_name);

        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'featured' => 'uploads/posts/' . $featured_new_name,
            'slug' => str_slug($request->input('title'))
        ]);

        return redirect()->route('post')->with('success', 'Successfully Posted!');
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
        $post = Post::find($id);

        return view('admin.posts.edit')->with('post', $post)->with('categories', Category::all());
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
        $validatedData = $request->validate([
            'title' => 'required|max:255', //nullable|max:255|regex:/^[a-zA-Z]+$/u
            'featured' => 'image',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $post = Post::find($id);

        if($request->hasFile('featured')){
            $featured = $request->file('featured');
            $featured_new_name = time() . $featured->getClientOriginalName();
            $featured->move('uploads/posts', $featured_new_name);

            $post->featured = 'uploads/posts/' . $featured_new_name;
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->save();

        return redirect()->route('post')->with('success', 'Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $postTitle = $post->title; 
        $post->delete();

        return redirect()->route('post')->with('success', 'Successfully Trashed: ' . $postTitle);
    }

    public function trash(){
        return view('admin.posts.trash')->with('posts', Post::onlyTrashed()->get());
    }

    public function restore($id){
        if(($post = Post::withTrashed()->where('id', $id)->first()) !== null){
            $post->restore();
            
            return redirect()->route('post.trash')->with('success', 'Post Restored: ' . $post->title);
        }else{
            return redirect()->route('post.trash')->with('error', 'No such Data Found!');
        }
    }

    public function kill($id){
        if(($post = Post::withTrashed()->where('id', $id)->first()) !== null){
            $post->forceDelete();
            return redirect()->route('post.trash')->with('success', 'Deleted Permanently: ' . $post->title);
        }else{
            return redirect()->route('post.trash')->with('error', 'No such Data Found!');
        }
    }
}
