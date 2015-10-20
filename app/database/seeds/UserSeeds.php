<?php

use App\Models\User;

class UserSeeds {
    function run()
    {
        $user = new User;
        $user->email = "test@test.com";
        $user->username = "testuser";
        $user->password = "password";
        $user->save();
    }
}