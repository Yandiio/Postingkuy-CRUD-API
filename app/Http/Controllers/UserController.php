<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Transformers\UserTransformer;
use Auth;

class UserController extends Controller{
    public function Users(User $user){
        
        $users = $user->all();

        return fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->toArray();    
    }

    public function profile(User $user){
        $users = $user->find(Auth::user()->id);
        return fractal()
            ->item($users)
            ->transformWith(new UserTransformer)
            ->includePost()
            ->toArray();
    }


}
