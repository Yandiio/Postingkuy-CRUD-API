<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Transformers\PostTransformer;
use App\User;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
