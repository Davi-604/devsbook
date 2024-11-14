<?php

namespace src\services;

use src\models\Follow;
use src\models\User;


class FollowService
{
    public static function getFollowing(int $id_user): array
    {
        $following = [];
        $followingReq = Follow::select()->where('user_from', $id_user)->get();
        foreach ($followingReq as $followingItem) {
            $followingUserReq = User::select()->where('id', $followingItem['user_to'])->one();

            $followingUser = new User();
            $followingUser->setId($followingUserReq['id']);
            $followingUser->setName($followingUserReq['name']);
            $followingUser->setAvatar($followingUserReq['avatar']);

            array_push($following, $followingUser);
        }

        return $following;
    }
    public static function getFollowers(int $id_user): array
    {
        $followers = [];
        $followersReq = Follow::select()->where('user_to', $id_user)->get();
        foreach ($followersReq as $followerItem) {
            $followersUserReq = User::select()->where('id', $followerItem['user_from'])->one();

            $followersUser = new User();
            $followersUser->setId($followersUserReq['id']);
            $followersUser->setName($followersUserReq['name']);
            $followersUser->setAvatar($followersUserReq['avatar']);

            array_push($followers, $followersUser);
        }

        return $followers;
    }

    public static function checkIfIsFollowing(int $from, int $to): bool
    {
        $req = Follow::select()
            ->where('user_from', $from)
            ->where('user_to', $to)
            ->one();

        if ($req) {
            return true;
            exit;
        }

        return false;
    }

    public static function follow(int $from, int $to): bool
    {
        $req = Follow::insert([
            'user_from' => $from,
            'user_to' => $to
        ])->execute();

        if ($req) {
            return true;
            exit;
        }

        return false;
    }

    public static function unfollow(int $from, int $to): bool
    {
        $req = Follow::delete()
            ->where('user_from', $from)
            ->where('user_to', $to)
            ->execute();

        if ($req) {
            return true;
            exit;
        }

        return false;
    }
}
