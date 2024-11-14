<?php

namespace src\services;

use src\models\Follow;
use src\models\User;

class LoginService
{
    public static function checkLogin()
    {
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $req = User::select()->where('token', $token)->one();
            if (count($req) > 0) {
                $user = new User();

                $user->setId($req['id']);
                $user->setName($req['name']);
                $user->setEmail($req['email']);
                $user->setPasswordHash($req['password']);
                $user->setBirthdate($req['birthdate']);
                $user->setAvatar($req['avatar']);
                $user->setCover($req['cover']);
                $user->setCity($req['city']);
                $user->setWork($req['work']);

                return $user;
            }
        }
        return false;
    }

    public static function validateLogin(string $email, string $password)
    {
        $user = User::select()->where('email', $email)->one();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $token = md5(time() . rand(0, 9999) . time());

                User::update()
                    ->set('token', $token)
                    ->where('id', $user['id'])
                    ->execute();

                return $token;
            }
        }

        return false;
    }
}
