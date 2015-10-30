<?php

use App\Models\User;

class UserSeeds {
    function run()
    {
        $user = new User;
        $user->email = "admin@domain.com";
        $user->username = "admin";
        $user->password = "admin";
        $user->save();
    }
}