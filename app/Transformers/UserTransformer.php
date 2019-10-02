<?php
namespace App\Transformers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\PostTransformers;

class UserTransformer extends TransformerAbstract{

    protected $availableIncludes = ['posts'];

    public function transform(user $user){
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'registered' => $user->created_at->diffForHumans(),
            'token' => $user->api_token
        ];
    }

    public function includePost(User $user){
         $posts = $user->posts;

         return $this->collection($posts,new PostTransformer);
    }
}