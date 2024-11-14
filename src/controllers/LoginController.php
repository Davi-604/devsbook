<?php

namespace src\controllers;

use \core\Controller;
use src\services\LoginService;
use src\services\UserService;

class LoginController extends Controller
{

    public function singin()
    {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('singin', [
            'flash' => $flash
        ]);
    }
    public function singin_action()
    {
        $isEmailValid = !empty(trim($_POST['email'])) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $isPasswordValid = !empty(trim($_POST['password']));

        if ($isEmailValid && $isPasswordValid) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $token = LoginService::validateLogin($email, $password);
            if ($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');
                exit;
            }
        }

        $_SESSION['flash'] = 'Email/senha inválidos.';
        $this->redirect('/singin');
    }

    public function singup()
    {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('singup', [
            'flash' => $flash
        ]);
    }

    public function singup_action()
    {
        $isNameValid = !empty(trim($_POST['name']));
        $isEmailValid = !empty(trim($_POST['email'])) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $isPasswordValid = !empty(trim($_POST['password']));
        $isBirthdateValid = !empty(trim($_POST['birthdate']));

        if ($isNameValid && $isEmailValid && $isPasswordValid && $isBirthdateValid) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $birthdate = $_POST['birthdate'];

            if (strtotime($birthdate)) {
                if (UserService::emailExists($email) === false) {
                    $token = UserService::addUser($name, $email, $password, $birthdate);
                    $_SESSION['token'] = $token;

                    $this->redirect('/');
                    exit;
                } else {
                    $_SESSION['flash'] = 'Usuário já cadastrado';
                    $this->redirect('/singup');
                    exit;
                }
            }


            $_SESSION['flash'] = 'Data de nascimento inválida ';
            $this->redirect('/singup');
            exit;
        }
        $_SESSION['flash'] = 'Dados inválidos';
        $this->redirect('/singup');
    }

    public function logout()
    {
        $_SESSION['token'] = '';
        $this->redirect('/singin');
    }
}
