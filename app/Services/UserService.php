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

    public function registerUser($name, $password, $firstName, $secondName, $email, $phone, $type){
        $sessionToken = $this->generateRandomToken();
        $user = $this->userDao->create($name, $password, $firstName, $secondName, $email, $type, $phone, $sessionToken);
        
        return $user;
    }

    public function uploadImage($image, $userId){
        if ($userId != null && $userId != 1){
            $path = "UserImage/".$user_id;

        }
        $fileName = $image->getClientOriginalName();
        $filePath = public_path($path);
        $image->move($filePath, $fileName);
        $this->uploadImagePath($userId, $filePath. "/". $fileName);
        Log::debug("path: ".str($path));

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

    }

    public function uploadImagePath($user_id, $imagePath){
        $this->userDao->uploadImagePath($user_id, $imagePath);

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
        Log::info("founders");
        // Log::debug(implode(",",$this->userDao->getByStartUpIdFounders($startup_id)));
        return $this->userDao->getByStartUpIdFounders($startup_id);
    }
    public function getUsersInStartUpInversors($startup_id){
        return $this->userDao->getByStartUpIdInversors($startup_id);
    }


    public function updateById($user_id, $email, $name, $firstName, $secondName){
        return $this->userDao->updateById($user_id, $email, $name, $firstName, $secondName);
    }


    public function getUserBySession($session)
    {
        return $this->userDao->getUserBySession($session);

    }


}
