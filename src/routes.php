<?php

use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');

$router->get('/singin', 'LoginController@singin');
$router->post('/singin', 'LoginController@singin_action');
$router->get('/singup', 'LoginController@singup');
$router->post('/singup', 'LoginController@singup_action');
$router->get('/logout', 'LoginController@logout');

$router->post('/post', 'PostController@new_post');
$router->get('/post/{id}/delete', 'PostController@delete_post');

$router->get('/profile/{id}/photos', 'UserController@photos');
$router->get('/profile/{id}/friends', 'UserController@friends');
$router->get('/profile/{id}/follow', 'FollowController@follow_action');
$router->get('/profile/{id}', 'UserController@profile');
$router->get('/profile', 'UserController@profile');

$router->get('/friends', 'UserController@friends');

$router->get('/photos', 'UserController@photos');
$router->post('/photos', 'UserController@new_photo');

$router->get('/config', 'UserController@config');
$router->post('/config', 'UserController@config_action');

$router->get('/search', 'SearchController@search');

$router->get('/ajax/like/{id}', 'AjaxController@like');

$router->post('/ajax/comment', 'AjaxController@comment');
$router->post('/ajax/upload', 'AjaxController@upload');
