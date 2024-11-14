<?php

namespace src\services;

use src\models\User;
use src\models\Post;


class UserService
{
    public static function emailExists(string $email)
    {
        $user = User::select()->where('email', $email)->one();
        return $user ? true : false;
    }

    public static function getUser(int $id, bool $fullData = false)
    {
        $req = User::select()->where('id', $id)->one();
        if ($req) {
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

            if ($fullData) {
                $following = FollowService::getFollowing($req['id']);
                $user->setFollowing($following);

                $followers = FollowService::getFollowers($req['id']);
                $user->setFollowers($followers);

                $photos = PostService::getPhotosFrom($id);
                $user->setPhotos($photos);
            }

            return $user;
            exit;
        }

        return false;
    }

    public static function addUser(string $name, string $email, string $password, $birthdate)
    {
        $passwordHash = \password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time() . rand(0, 9999) . time());

        User::insert([
            'name' => $name,
            'email' => $email,
            'password' => $passwordHash,
            'birthdate' => $birthdate,
            'avatar' => 'avatar.jpg',
            'cover' => 'cover.jpg',
            'city' => '',
            'work' => '',
            'token' => $token
        ])->execute();

        return $token;
    }

    public static function updateUser(
        int $idUser,
        string $avatar,
        string $cover,
        string $name,
        string $email,
        $birthdate,
        string $city,
        string $work,
        string $password,
    ) {

        User::update()
            ->set('avatar', $avatar)
            ->set('cover', $cover)
            ->set('name', $name)
            ->set('email', $email)
            ->set('birthdate', $birthdate)
            ->set('city', $city)
            ->set('work', $work)
            ->set('password', $password)
            ->where('id', $idUser)
            ->execute();

        return true;
        exit;
    }

    public static function searchUser(string $value): array
    {
        $searchReq = User::select()->where('name', 'like', "%$value%")->get();
        $users = [];
        foreach ($searchReq as $result) {
            $user = new User();

            $user->setId($result['id']);
            $user->setName($result['name']);
            $user->setAvatar($result['avatar']);

            array_push($users, $user);
        }

        return $users;
    }
}
