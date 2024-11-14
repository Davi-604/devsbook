<?php


namespace src\controllers;


use \core\Controller;
use \DateTime;
use \src\services\LoginService;
use \src\services\UserService;
use \src\services\PostService;
use \src\services\FollowService;
use \src\utils\ImageUtil;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = LoginService::checkLogin();

        if ($this->user === false) {
            $this->redirect('/singin');
        }
    }

    public function profile($params = [])
    {
        $id = $this->user->getId();
        if (!empty($params['id'])) {
            $id = $params['id'];
        }

        $user = UserService::getUser($id, true);
        if ($user === false) {
            $this->redirect('/');
            exit;
        }

        $page = intval(filter_input(INPUT_GET, 'page'));
        $userFeed = PostService::getUserFeed($id, $this->user->getId(), $page);

        if ($id != $this->user->getId()) {
            $isFollowing = false;
            $isFollowing = FollowService::checkIfIsFollowing($this->user->getId(), $id);
        }

        $birthdate = new DateTime($user->getBirthdate());
        $today = new DateTime();

        $age = $today->diff($birthdate)->y;

        $this->render('profile', [
            'user' => $user,
            'loggedUser' => $this->user,
            'feed' => $userFeed,
            'currentPage' => $page,
            'isFollowing' => $isFollowing ?? null,
            'age' => $age,
        ]);
    }

    public function friends($params = [])
    {
        $id = $this->user->getId();
        if (!empty($params['id'])) {
            $id = $params['id'];
        }

        $user = UserService::getUser($id, true);
        if ($user === false) {
            $this->redirect('/');
            exit;
        }

        if ($id != $this->user->getId()) {
            $isFollowing = false;
            $isFollowing = FollowService::checkIfIsFollowing($this->user->getId(), $id);
        }

        $this->render('friends', [
            'user' => $user,
            'loggedUserId' => $this->user->getId(),
            'isFollowing' => $isFollowing ?? null
        ]);
    }

    public function photos($params = [])
    {
        $id = $this->user->getId();
        if (!empty($params['id'])) {
            $id = $params['id'];
        }

        $user = UserService::getUser($id, true);
        if ($user === false) {
            $this->redirect('/');
            exit;
        }

        if ($id != $this->user->getId()) {
            $isFollowing = false;
            $isFollowing = FollowService::checkIfIsFollowing($this->user->getId(), $id);
        }

        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('user_photos', [
            'user' => $user,
            'loggedUserId' => $this->user->getId(),
            'isFollowing' => $isFollowing ?? null,
            'flash' => $flash
        ]);
    }


    public function new_photo()
    {
        $photo = $_FILES['photo'];

        if (!empty(trim($photo['tmp_name'])) && isset($_FILES['photo'])) {
            if (in_array($photo['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                $photoName = ImageUtil::formatImage($photo, 800, 800, 'media/uploads');
                PostService::addPost($this->user->getId(), $photoName, 'photo');
            } else {
                $_SESSION['flash'] = 'Formato de imagem inválido! (aceitando somente: .jpeg, .jpg e .png)';
            }
        } else {
            $_SESSION['flash'] = 'Campo de imagem vazio!';
        }

        $this->redirect('/photos');
        exit;
    }

    public function config()
    {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('config', [
            'user' => $this->user,
            'flash' => $flash
        ]);
    }

    public function config_action()
    {
        $cover = $_FILES['cover'];
        $avatar = $_FILES['avatar'];
        $name = $_POST['name'];
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $birthdate = $_POST['birthdate'];
        $city = $_POST['city'];
        $work = $_POST['work'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        $avatarName = $this->user->getAvatar();
        if (!empty($avatar['tmp_name'])) {
            if (in_array($avatar['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                $avatarName = ImageUtil::formatImage($avatar, 200, 200, 'media/avatars');
            }
        }

        $coverName = $this->user->getCover();
        if (!empty($cover['tmp_name'])) {
            if (in_array($cover['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                $coverName = ImageUtil::formatImage($cover, 200, 200, 'media/covers');
            } else {
                $_SESSION['flash'] = 'Formato de imagem inválido! (aceitando somente: .jpeg, .jpg e .png)';
            }
        }

        if ($email === false) {
            $_SESSION['flash'] = 'Email inválido!';
            $this->redirect('/config');
            exit;
        }

        $emailExists = UserService::emailExists($email);
        if ($emailExists && $email != $this->user->getEmail()) {
            $_SESSION['flash'] = 'Email já cadastrado!';
            $this->redirect('/config');
            exit;
        }

        $passwordHash = $this->user->getPasswordHash();
        if (!empty(trim($password))) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            if ($password != $password_confirm) {
                $_SESSION['flash'] = 'Confirmação de senha inválida!';
                $this->redirect('/config');
                exit;
            }
        }

        UserService::updateUser(
            $this->user->getId(),
            $avatarName,
            $coverName,
            $name,
            $email,
            $birthdate,
            $city,
            $work,
            $passwordHash
        );

        $this->redirect('/profile');
        exit;
    }
}
