<?php

namespace src\models;

use \core\Model;
use src\models\NecessaryUserInformation;


class Post extends Model
{
    private int $id;
    private int $id_user;
    private string $body;
    private string $type;
    private string $created_at;
    private NecessaryUserInformation $userPost;
    private bool $mine;
    private array $comments;
    private int $commentsCount;
    private array $commentUsers;
    private int $likesCount;
    private bool $liked;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): int
    {
        $this->id = $id;
        return $this->id;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }
    public function setIdUser(int $id_user): int
    {
        $this->id_user = $id_user;
        return $this->id_user;
    }

    public function getBody(): string
    {
        return $this->body;
    }
    public function setBody(string $body): string
    {
        $this->body = $body;
        return $this->body;
    }

    public function getType(): string
    {
        return $this->type;
    }
    public function setType(string $type): string
    {
        $this->type = $type;
        return $this->type;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    public function setCreatedAt(string $created_at): string
    {
        $this->created_at = $created_at;
        return $this->created_at;
    }

    public function getUserPost(): NecessaryUserInformation
    {
        return $this->userPost;
    }
    public function setUserPost(NecessaryUserInformation $userPost): NecessaryUserInformation
    {
        $this->userPost = $userPost;
        return $this->userPost;
    }

    public function getMine(): bool
    {
        return $this->mine;
    }
    public function setMine(bool $mine): bool
    {
        $this->mine = $mine;
        return $this->mine;
    }

    public function getComments(): array
    {
        return $this->comments;
    }
    public function setComments($comments): array
    {
        $this->comments = $comments;
        return $this->comments;
    }
    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }
    public function setCommentsCount(int $commentsCount): int
    {
        $this->commentsCount = $commentsCount;
        return $this->commentsCount;
    }
    public function getCommentUsers(): array
    {
        return $this->commentUsers;
    }
    public function setCommentUsers(array $userComment): array
    {
        $this->commentUsers = $userComment;
        return $this->commentUsers;
    }

    public function getLikesCount(): int
    {
        return $this->likesCount;
    }
    public function setLikesCount(int $likesCount): int
    {
        $this->likesCount = $likesCount;
        return $this->likesCount;
    }

    public function getLiked(): bool
    {
        return $this->liked;
    }
    public function setLiked(bool $liked): bool
    {
        $this->liked = $liked;
        return $this->liked;
    }
}
