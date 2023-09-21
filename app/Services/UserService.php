<?php

namespace App\Services;

use App\Daos\UserDao;
use http\Env\Request;
use Illuminate\Support\Facades\Log;

class UserService
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
        if (!$user || !password_verify($password, $user->password)) {
            Log::debug("do login  fail");
            return false;
        }
        return true;
    }

    public function getByEmail($email) {
        return $this->userDao->getByEmail($email);
    }

    public function getUserById($id){
        return $this->userDao->getUserById($id);
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

    public function getUsersInStartUpFounders($startup_id){
        return $this->userDao->getByStartUpIdFounders($startup_id);
    }
    public function getUsersInStartUpInversors($startup_id){
        return $this->userDao->getByStartUpIdInversors($startup_id);
    }



}
