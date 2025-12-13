<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read categories')->only(['index']);
        $this->middleware('can:create categories')->only(['create', 'store']);
        $this->middleware('can:update categories')->only(['edit', 'update']);
        $this->middleware('can:delete categories')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        Category::create([
            'name' => [
                'ar' => $data['name_ar'],
                'en' => $data['name_en'],
            ]
        ]);

        return redirect()->route('admin.categories.index')->with("message", __("messages.CREATEDSUCCESSFULLY"));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Category = Category::findOrFail($id);
        $Category->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
