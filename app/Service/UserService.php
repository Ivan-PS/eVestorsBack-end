<?php

namespace App\Service;

use App\Daos\UserDao;
use Illuminate\Support\Facades\Log;

class FolderService
{
    protected $userDao;

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    public function loginUser($email, $password){
        Log::debug("do login");
        $user = $this->userDao->getByEmail($email);
        Log::debug(strval($user));
        if (!$user || !password_verify($request->password, $user->password)) {
            Log::debug("do login  fail");
            return false;
        }
        return true;
    }

    public function registerUser($name, $password, $firstName, $secondName, $email, $type){
        $sessionToken = $this->generateRandomToken();
        $user = $this->userDao->create($name, $password, $firstName, $secondName, $email, $type, $sessionToken);
        return $user;
    }

    public function generateRandomToken() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $String = '';
        for ($i = 0; $i < 20; ++$i) {
            $String .= $characters[rand(0, $charactersLength - 1)];
        }

        return $String;
    }



}
