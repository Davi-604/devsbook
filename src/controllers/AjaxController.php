<?php

namespace src\controllers;

use \core\Controller;
use \src\services\LoginService;
use \src\services\PostService;
use \src\utils\ImageUtil;

class AjaxController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = LoginService::checkLogin();
        if ($this->user === false) {
            header('Content-type: application/json');
            echo json_encode(['error' => 'Usuário não logado!']);
            exit;
        }
    }

    public function like($params)
    {
        $idPost = $params['id'];
        \var_dump($idPost);

        if (PostService::checkIfPostIsLiked($idPost, $this->user->getId())) {
            PostService::unlikePost($idPost, $this->user->getId());
        } else {
            PostService::likePost($idPost, $this->user->getId());
        }
    }

    public function comment()
    {
        $res = [
            'error' => ''
        ];

        $id_post = $_POST['id'];
        $value = $_POST['txt'];

        if (!empty(trim($id_post)) && !empty(trim($value))) {
            PostService::addComment($id_post, $this->user->getId(), $value);

            $res['link'] = '/profile/' . $this->user->getId();
            $res['avatar'] = '/media/avatars/' . $this->user->getAvatar();
            $res['name'] = $this->user->getName();
            $res['body'] = $value;
        }

        header('Content-type: application/json');
        echo json_encode($res);
        exit;
    }

    public function upload()
    {
        $res = [
            'error' => ''
        ];

        $photo = $_FILES['photo'];

        if (!empty(trim($photo['tmp_name'])) && isset($_FILES['photo'])) {
            $photoName = ImageUtil::formatImage($photo, 800, 800, 'media/uploads');

            PostService::addPost($this->user->getId(), $photoName, 'photo');
        } else {
            $res['error'] = 'Nenhuma imagem foi enviada!';
        }

        header('Content-type: application/json');
        echo json_encode($res);
        exit;
    }
}
