<?php

namespace App\Repositories;

use App\Models\User;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class UserRepo
{

    public function all() {

        $user = User::all();
        return $user;
    }

}
