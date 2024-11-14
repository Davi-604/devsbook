<?php

namespace src\controllers;

use \core\Controller;
use \src\services\LoginService;
use \src\services\UserService;
use \src\services\PostService;

class SearchController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = LoginService::checkLogin();
        if ($this->user === false) {
            $this->redirect('/singin');
        }
    }

    public function search()
    {
        $searchValue = filter_input(INPUT_GET, 's');
        if (empty($searchValue)) {
            $this->redirect('/');
            exit;
        }

        $page = intval(filter_input(INPUT_GET, 'page'));

        $searchedUsers = UserService::searchUser($searchValue);
        $searchedPosts = PostService::searchPost($searchValue, $this->user->getId(), $page);


        $this->render('search', [
            'user' => $this->user,
            'searchValue' => $searchValue,
            'userResults' => $searchedUsers,
            'postResults' => $searchedPosts['posts'],
            'currentPage' => $page,
            'pageCount' => $searchedPosts['pageCount']
        ]);
    }
}
