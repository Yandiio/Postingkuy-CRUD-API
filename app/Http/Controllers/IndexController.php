<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Transformers\PostTransformer;
use App\User;


class IndexController extends Controller
{

    public function create(Request $request,Post $post)
    {
        $this->validate($request,[
            'posts' => 'required|min:10',
        ]);
        
        $post = Post::Create([
            'user_id' => Auth::user()->id,
            'posts' => $request->posts,
            ]);
            
            $response = fractal()
                ->item($post)
                ->transformWith(new PostTransformer)
                ->toArray();
            
            return response()->json($response,201);
    }

    public function update(Request $request,Post $post)
    {
    
       $this->authorize('update',$post);

       $post->posts = $request->get('posts',$post->posts);
       $post->save();

        $response = fractal()
            ->item($post)
            ->TransformWith(new PostTransformer)
            ->toArray();

        return response()->json($response,201);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
