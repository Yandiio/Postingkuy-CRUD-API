<?php
namespace App\Transformers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract{
    public function transform(Post $post){
        return [
            'id' => $post->id,
            'posts' => $post->posts,
            'published' => $post->created_at->diffForHumans(),
        ];
    }
}