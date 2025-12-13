<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $post = Post::latest()->first();
        $categoryId = $post->category_id;
        $relatedPosts = Post::where('category_id', $categoryId)
            ->where('id', '!=', $post->id)
            ->latest()
            ->paginate(10);
        return view('website.posts.index', compact('post', 'relatedPosts', 'categories'));
    }

    /**
     * Display posts by category.
     */
    public function postsByCategory($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        $post = $category->posts()->latest()->first();
        $posts = $category->posts()->where('id','!=',$post->id)->latest()->paginate(10);
        return view('website.posts.bycategories', compact('categories', 'post', 'posts'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        $categoryId = $post->category_id;
        $relatedPosts = Post::where('category_id', $categoryId)
            ->where('id', '!=', $post->id)
            ->latest()
            ->paginate(10);
        return view('website.posts.show', compact('post', 'relatedPosts'));
    }
}
