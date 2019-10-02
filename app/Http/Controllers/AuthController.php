<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transformers\UserTransformer;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request,User $user)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'password' => 'required|unique:users',
            'email' => 'required|min:6',
        ]);

        $users = User::create([
            'name' =>$request->name,
            'password'=>bcrypt($request->password),
            'email'=> $request->email,
            'api_token' => Str::random(100),
        ]); 


        $response = fractal()
            ->item($users)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $users->api_token
            ]);
         return response()->json($response,201);
    }

    public function login(Request $request,User $user){
        if(!Auth::attempt(['email'=> $request->email,'password'=>$request->password ])){
            return response()->json(['error' => 'Your credential not match'],404);
        }

        $users = $user::find(Auth::user()->id);
        
        return fractal()
            ->item($users)
            ->transformWith(new UserTransformer)
            ->addMeta([
               'token' => $users->api_token,
            ]);
    }
}
