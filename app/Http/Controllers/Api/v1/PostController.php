<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;


class PostController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {

        $category = Category::findOrFail($request->category_id);
        $posts = $category->posts;

        $data = [
            'posts' => $posts
        ];

        return $this->apiDataResponse($data);
    }


    public function toggleFavorite($id)
    {
        $client = auth('api')->user();
        $post = Post::findOrFail($id);

        $pivot = $client->fav()->where('post_id', $post->id)->first();

        if ($pivot) {
            $isFavorite = $pivot->pivot->is_favorite ? 0 : 1;
            $client->fav()->updateExistingPivot($id, ['is_favorite' => $isFavorite]);
        } else {
            $client->fav()->attach([
                $id => ['is_favorite' => 1]
            ]);
        }
        return $this->apiSuccessMessage('Favorite status updated');
    }


    public function favoritePosts()
    {

        $client = auth('api')->user();

        $favoritePosts = $client->fav()
            ->wherePivot('is_favorite', 1)
            ->get();
            
        $data=[         
            'favorites' => $favoritePosts
        ];
        return $this->apiDataResponse($data);
    }
}
