<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read posts')->only(['index']);
        $this->middleware('can:create posts')->only(['create', 'store']);
        $this->middleware('can:update posts')->only(['edit', 'update']);
        $this->middleware('can:delete posts')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate('10');
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }


    /**
     * Display a list of posts belonging to a specific category.
     */
    public function postsByCategory(string $id)
    {
        $posts = Post::where('category_id', $id)->paginate(10);
        $categories = Category::all();
        return view('admin.posts.show', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        if ($request->hasFile("image")) {
            $image = $request->image;
            $folder = date('Y/m/d');
            $imageName = time() . rand(1, 100) . "." . $image->extension();
            $image->move(public_path('img/posts/' . $folder), $imageName);

            $imagePath = 'img/posts/' . $folder . '/' . $imageName;
        } else {
            $imagePath = null;
        }

        Post::create(array_merge($request->validated(), ['images' => $imagePath]));

        return redirect()->route('admin.posts.index')->with("message", __("messages.CREATEDSUCCESSFULLY"));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);

        if ($request->hasFile("image")) {
            File::delete($post->images);
            $image = $request->image;
            $folder = date('Y/m/d');
            $imageName = time() . rand(1, 100) . "." . $image->extension();
            $image->move(public_path('img/posts/' . $folder), $imageName);

            $imagePath = 'img/posts/' . $folder . '/' . $imageName;
        } else {
            $imagePath = $post->images;
        }

        $post->update(array_merge($request->validated(), ['images' => $imagePath]));

        return redirect()->route('admin.posts.index')->with("message",  __("messages.UPDATEDSUCCESSFULLY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $imagePath = $post->images;
        $post->delete();

        if (!empty($imagePath)) {
            $fullImagePath = public_path($imagePath);
            if (File::exists($fullImagePath)) {
                File::delete($fullImagePath);
            }
        }
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
