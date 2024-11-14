<?php

namespace src\models;

use \core\Model;

class Follow extends Model
{
    private int $id;
    private int $user_from;
    private int $user_to;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): int
    {
        $this->id = $id;
        return $this->id;
    }

    public function getUserFrom(): int
    {
        return $this->user_from;
    }
    public function setUserFrom(int $user_from): int
    {
        $this->user_from = $user_from;
        return $this->user_from;
    }

    public function getUserTo(): string
    {
        return $this->user_to;
    }
    public function setUserTo(string $user_to): string
    {
        $this->user_to = $user_to;
        return $this->user_to;
    }
}
