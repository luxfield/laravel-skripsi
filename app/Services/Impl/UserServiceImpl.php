<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\DB;

class UserServiceImpl implements UserService
{

    public function login(string $user, string $password): bool
    {
        $user = DB::table('users')->where('email','=',$user)->get();
        return $user->value('password') == $password;

    }
}
