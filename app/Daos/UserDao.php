<?php

namespace App\Daos;

use App\Models\User;
use App\Models\InversionPermision;
use App\Models\StartupPermision;
use Illuminate\Support\Facades\Log;

class UserDao
{
    public function create($name, $password, $firstName, $secondName, $email, $type, $phone, $tokenSession)
    {



        $user = User::create([
            "name"=> $name,
            "password"=> $password,
            "email"=> $email,
            "firstName"=> $firstName,
            "secondName"=> $secondName,
            "type"=> $type,
            "phone"=> $phone, 
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


        $user = User::where('id', $id)->first();
        return $user;

    }

    public function getByStartUpIdFounders($startup_id){
        $permisions = StartupPermision::where('startup_id', $startup_id)->get();
        $users = [];

        foreach ($permisions as $permision){
            $user = $this->getById($permision["user_id"]);
            array_push($users, $user);
        }
        return $users;
    }

    public function getByStartUpIdInversors($startup_id){
        $inversions = InversionPermision::where('startup_id', $startup_id)->get();
        $users = [];

        foreach ($inversions as $inversion){
            $user = $this->getById($inversion["user_id"]);
            array_push($users, $user);
        }
        return $users;
    }

    public function updateFbToken($user_id, $tokenFb)
    {
        $user = User::where('id', $user_id)
            ->update([
                'fbToken' => $tokenFb
            ]);
        return $user;
    }

    public function updateById($user_id, $email, $name, $firstName, $secondName)
    {
        $user = User::where('id', $user_id)
            ->update([
                'email' => $email,
                "name" => $name,
                "firstName" => $firstName,
                "secondName" => $secondName
            ]);
        return $user;
    }

    public function getUserBySession($session)
    {
        $user = User::where('sessionToken', $session)->first();
        return $user;
    }

    public function uploadImagePath($user_id, $imagePath){
        $user = User::where('id', $user_id)
        ->update([
            'imagePath' => $imagePath,
        ]);
    }

}
