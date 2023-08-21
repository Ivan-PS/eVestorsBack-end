<?php

namespace App\Daos;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserDao
{
    public function create($name, $password, $firstName, $secondName, $email, $type, $tokenSession)
    {



        $user = User::create([
            "name"=> $name,
            "password"=> $password,
            "email"=> $email,
            "firstName"=> $firstName,
            "secondName"=> $secondName,
            "type"=> $type,
            "sessionToken" => $tokenSession
        ]);

        return $user;

    }


    function getByEmail($email){
        $user = User::where('email', $email)->first();
        return $user;
    }


    public function getById($id)
    {


        $user = User::where('id', $id)->get();
        return $user;

    }

}
