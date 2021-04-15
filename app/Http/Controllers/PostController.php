<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function _construct(){
        $this->middleware('auth',['except'=>['index']]);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index')->with('posts',Post::orderBy('updated_at','DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg,jpg|max:2048'
        ]);
        $imageName=uniqid().'-'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);

        Post::create([
            'user_id'=>auth()->user()->id,
            'slug'=>SlugService::createSlug(Post::class,'slug',$request->title),
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'image_path'=>$imageName
        ]);

        return redirect('products')
        ->with('message','Your post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('products.show')
        ->with('post',Post::where('slug',$slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('products.edit')
        ->with('post',Post::where('slug',$slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg,jpg|max:2048'
        ]);
          $imageName=uniqid().'-'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);
        Post::where('slug',$slug)
        ->update([
            'user_id'=>auth()->user()->id,
            'slug'=>SlugService::createSlug(Post::class,'slug',$request->title),
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'image_path'=>$imageName
        ]);
        return redirect('products')
        ->with('message','Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post=Post::where('slug',$slug);
        $post->delete();
        return redirect('/products')
        ->with('message','Your post has been deleted!');
    }
}
