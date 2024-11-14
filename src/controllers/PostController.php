<?php

namespace src\controllers;

use \core\Controller;
use \src\services\LoginService;
use \src\services\PostService;
use src\utils\ImageUtil;

class PostController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = LoginService::checkLogin();
        if ($this->user === false) {
            $this->redirect('/singin');
        }
    }

    public function new_post()
    {
        $isBodyValid = !empty(trim($_POST['body']));

        if ($isBodyValid) {
            $body = $_POST['body'];

            $req = PostService::addPost($this->user->getId(), $body, 'text');
            if ($req) {
                $this->redirect('/');
            }
        }

        return false;
    }

    public function delete_post($params)
    {
        $id_post = $params['id'];

        if (!empty(trim($id_post))) {
            PostService::deletePost($id_post, $this->user->getId());
        }

        return $this->redirect('/');
    }
}
