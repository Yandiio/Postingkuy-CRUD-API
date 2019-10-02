<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Arief Muhammad";
        $user->password = Hash::make("arief112");
        $user->email="ariefcuan@gmail.com";
        $user->api_token = Str::random(100);

        $user->save();
    }
}
