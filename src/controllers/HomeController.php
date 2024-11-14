<?php

namespace src\controllers;

use \core\Controller;
use \src\services\LoginService;
use \src\services\PostService;

class HomeController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = LoginService::checkLogin();
        if ($this->user === false) {
            $this->redirect('/singin');
        }
    }

    public function index()
    {
        $page = intval(filter_input(INPUT_GET, 'page'));

        $feed = PostService::getHomeFeed($this->user->getId(), $page);

        $this->render('home', [
            'user' => $this->user,
            'feed' => $feed,
            'currentPage' => $page
        ]);
    }
}
