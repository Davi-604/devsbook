<?php

namespace src\controllers;

use \core\Controller;
use \DateTime;
use src\models\Follow;
use \src\services\FollowService;
use \src\services\LoginService;
use \src\services\UserService;

class FollowController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = LoginService::checkLogin();
        if ($this->user === false) {
            $this->redirect('/singin');
        }
    }

    public function follow_action($params)
    {
        $to = intval($params['id']);

        $userExists = UserService::getUser($to);
        if ($userExists != false) {
            if (FollowService::checkIfIsFollowing($this->user->getId(), $to)) {
                FollowService::unfollow($this->user->getId(), $to);
                echo 'unfollow';
            } else {
                FollowService::follow($this->user->getId(), $to);
            }
        }

        $this->redirect('/profile/' . $to);
    }
}
