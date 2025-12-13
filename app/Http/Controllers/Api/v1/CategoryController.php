<?php

namespace App\Http\Controllers\Api\v1;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {

        $categories = Category::all();
        $data = [
            'categories' => $categories
        ];

        return $this->apiDataResponse($data);
    }
}