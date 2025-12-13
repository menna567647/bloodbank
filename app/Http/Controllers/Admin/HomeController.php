<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Client;
use App\Models\Report;
use App\Models\Category;
use App\Models\Post;

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
        $totalClients = Client::count();
        $totalReports = Report::count();
        $totalCategories = Category::count();
        $totalPosts = Post::count();
        return view('admin.dashboard', compact('totalClients', 'totalReports', 'totalCategories', 'totalPosts'));
    }

}
