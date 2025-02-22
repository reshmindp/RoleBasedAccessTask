<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('categories')->get();

        return view('app.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('app.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:posts,title',
            'description' => 'required|string',
            'categories' => 'required|array|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        if ($request->hasFile('image')) {

            $imageName = rand(1, 999);
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $image = $imageName.'.'.$imageExtension;
            $directory = 'public/uploads/post/';
            
            Storage::makeDirectory($directory);
            
            $request->file('image')->storeAs($directory, $image);

            $imagePath = 'uploads/post/'.$image;  
        }
    
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath ?? null,
        ]);
    
        $status = $post->categories()->attach($request->categories);
    
        $status ? Toastr::success("New post has been added!", "Success", ["positionClass" => "toast-bottom-left"]) : Toastr::error("Some error occurred", "Error", ["positionClass" => "toast-bottom-left"]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('app.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'categories' => 'required|array|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $post = Post::find($id);
        
        if ($request->hasFile('image')) {
            
            if ($post->image && Storage::exists('public/' . $post->image)) {
                Storage::delete('public/' . $post->image);
            }
    
             
            $imageName = rand(1, 999) . '.' . $request->file('image')->getClientOriginalExtension();
            $directory = 'public/uploads/post/';
    
            Storage::makeDirectory($directory);
            $request->file('image')->storeAs($directory, $imageName);
    
            $imagePath = 'uploads/post/' . $imageName;
        }
        
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath ?? $post->image,
        ]);
    
         
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }
    
        Toastr::success("Post has been updated!", "Success", ["positionClass" => "toast-bottom-left"]);
    
        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::where('id', $id)->first();

        Storage::delete('public/'.$post->image);

        $status = Post::findOrFail($id)->delete();
        $status ? Toastr::success("Selected Post details have been deleted!", "Success", ["positionClass" => "toast-bottom-left"]) : Toastr::error("Some error occurred","Error",["positionClass" => "toast-bottom-left"]);
        
        return redirect()->back();
    }
}
