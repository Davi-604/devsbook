<?php

namespace src\services;

use src\models\PostComment;
use src\models\Post;
use src\models\User;
use src\models\Follow;
use src\models\PostLike;

class PostService
{
    public static function addPost(int $idUser, string $body, string $type,)
    {
        if (!empty($idUser)) {
            Post::insert([
                'id_user' => $idUser,
                'body' => $body,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s')
            ])->execute();

            return true;
            exit;
        }

        return false;
    }

    public static function checkIfPostIsLiked(int $idPost, int $loggedUserId): bool
    {
        $liked = PostLike::select()
            ->where('id_post', $idPost)
            ->where('id_user', $loggedUserId)
            ->get();

        if (count($liked) > 0) {
            return true;
            exit;
        }

        return false;
    }

    public static function likePost(int $idPost, int $loggedUserId)
    {
        PostLike::insert([
            'id_post' => $idPost,
            'id_user' => $loggedUserId,
            'created_at' => date('Y-m-d H:i:s')
        ])->execute();
    }
    public static function unlikePost(int $idPost, int $loggedUserId)
    {
        PostLike::delete()
            ->where('id_post', $idPost)
            ->where('id_user', $loggedUserId)
            ->execute();
    }

    public static function addComment(int $id_post, int $id_user, string $value)
    {
        PostComment::insert([
            'id_post' => $id_post,
            'id_user' => $id_user,
            'body' => $value,
            'created_at' => date('Y-m-d H:i:s')
        ])->execute();
    }

    public static function _getFeedToObject(array $postList, int $loggedUserId)
    {

        $posts = [];
        foreach ($postList as $reqPost) {

            $commentsCount = PostComment::select()->where('id_post', $reqPost['id'])->count();
            $likesCount = PostLike::select()->where('id_post', $reqPost['id'])->count();

            $liked = self::checkIfPostIsLiked($reqPost['id'], $loggedUserId);

            $post = new Post();
            $post->setId($reqPost['id']);
            $post->setIdUser($reqPost['id_user']);
            $post->setBody($reqPost['body']);
            $post->setType($reqPost['type']);
            $post->setCreatedAt($reqPost['created_at']);
            $post->setCommentsCount($commentsCount);
            $post->setLikesCount($likesCount);
            $post->setLiked($liked);

            $post->setMine(false);
            if ($post->getIdUser() === $loggedUserId) {
                $post->setMine(true);
            }

            $reqUserPost = User::select()->where('id', $reqPost['id_user'])->one();

            $userPost = new User();
            $userPost->setId($reqUserPost['id']);
            $userPost->setName($reqUserPost['name']);
            $userPost->setAvatar($reqUserPost['avatar']);
            $post->setUserPost($userPost);

            $comments = [];
            $commentUsers = [];
            $reqComments = PostComment::select()->where('id_post', $reqPost['id'])->get();
            foreach ($reqComments as $commentItem) {
                $reqCommentUser = User::select()->where('id', $commentItem['id_user'])->one();

                $commentUser = new User();
                $commentUser->setId($reqCommentUser['id']);
                $commentUser->setName($reqCommentUser['name']);
                $commentUser->setAvatar($reqCommentUser['avatar']);

                array_push($commentUsers, $commentUser);

                $comment = new PostComment();
                $comment->setId($commentItem['id']);
                $comment->setIdPost($commentItem['id_post']);
                $comment->setIdUser($commentItem['id_user']);
                $comment->setBody($commentItem['body']);

                array_push($comments, $comment);
            }
            $post->setCommentUsers($commentUsers);
            $post->setComments($comments);


            array_push($posts, $post);
        }

        return $posts;
    }

    public static function getUserFeed(int $idUser, int $loggedUserId, int $page)
    {
        if (!empty($idUser)) {
            $perPage = 3;

            $reqPosts = Post::select()
                ->where('id_user', $idUser)
                ->orderBy('created_at', 'desc')
                ->page($page, $perPage)
                ->get();
            $posts = self::_getFeedToObject($reqPosts, $loggedUserId);

            $totalPosts = Post::select()
                ->where('id_user', $idUser)
                ->count();
            $totalPosts = ceil($totalPosts / $perPage);

            return [
                'posts' => $posts,
                'pageCount' => $totalPosts
            ];
        }

        return false;
    }
    public static function getHomeFeed(int $idUser, int $page)
    {
        if (!empty($idUser)) {
            $perPage = 3;

            $reqUsers = Follow::select()->where('user_from', $idUser)->get();
            $users = [];
            foreach ($reqUsers as $reqUser) {
                array_push($users, $reqUser['user_to']);
            }
            array_push($users, $idUser);

            $reqPosts = Post::select()
                ->where('id_user', 'in', $users)
                ->orderBy('created_at', 'desc')
                ->page($page, $perPage)
                ->get();
            $posts = self::_getFeedToObject($reqPosts, $idUser);


            $totalPosts = Post::select()
                ->where('id_user', 'in', $users)
                ->count();
            $totalPosts = ceil($totalPosts / $perPage);

            return [
                'posts' => $posts,
                'pageCount' => $totalPosts
            ];
        }

        return false;
    }

    public static function getPhotosFrom(int $idUser)
    {
        $photos = [];
        $photosReq = Post::select()
            ->where('id_user', $idUser)
            ->where('type', 'photo')
            ->get();

        foreach ($photosReq as $photoItem) {
            $photoPost = new Post();

            $photoPost->setId($photoItem['id']);
            $photoPost->setBody($photoItem['body']);
            $photoPost->setType($photoItem['type']);
            $photoPost->setCreatedAt($photoItem['created_at']);

            array_push($photos, $photoPost);
        }
        return $photos;
    }

    public static function searchPost(string $value, int $loggedUserId, int $page)
    {
        $perPage = 3;

        $searchReq = Post::select()
            ->where('body', 'like', "%$value%")
            ->where('type', 'text')
            ->orderBy('created_at', 'desc')
            ->page($page, $perPage)
            ->get();
        $posts = self::_getFeedToObject($searchReq, $loggedUserId);


        $totalPosts = Post::select()
            ->where('body', 'like', "%$value%")
            ->where('type', 'text')
            ->count();
        $totalPosts = ceil($totalPosts / $perPage);

        return [
            'posts' => $posts,
            'pageCount' => $totalPosts
        ];
    }

    public static function deletePost(int $id_post, int $id_user)
    {
        $post = Post::select()
            ->where('id', $id_post)
            ->where('id_user', $id_user)
            ->one();

        if (isset($post)) {
            PostLike::delete()->where('id_post', $post['id'])->execute();
            PostComment::delete()->where('id_post', $post['id'])->execute();

            if ($post['type'] === 'photo') {
                $img = "media/uploads/" . $post['body'];
                if (file_exists($img)) {
                    unlink($img);
                }
            }

            Post::delete()->where('id', $post['id'])->execute();
        }
    }
}
