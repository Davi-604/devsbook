<?php

namespace src\models;

use \core\Model;

class PostComment extends Model
{
    private int $id;
    private int $id_post;
    private int $id_user;
    private string $body;
    private string $created_at;

    public function getId(): string
    {
        return $this->id;
    }
    public function setId(string $id): string
    {
        $this->id = $id;
        return $this->id;
    }

    public function getIdPost(): string
    {
        return $this->id_post;
    }
    public function setIdPost(string $id_post): string
    {
        $this->id_post = $id_post;
        return $this->id_post;
    }

    public function getIdUser(): string
    {
        return $this->id_user;
    }
    public function setIdUser(string $id_user): string
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

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    public function setCreatedAt(string $created_at): string
    {
        $this->created_at = $created_at;
        return $this->created_at;
    }
}
