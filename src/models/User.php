<?php

namespace src\models;

use \core\Model;
use src\models\Follow;

interface NecessaryUserInformation
{
    public function getId(): int;
    public function getName(): string;
    public function getAvatar(): string;
}

class User extends Model implements NecessaryUserInformation
{
    private int $id;
    private string $name;
    private string $email;
    private string $passwordHash;
    private string $birthdate;
    private string $avatar;
    private string $cover;
    private string $city;
    private string $work;
    private array $photos = [];
    /**
     * @var NecessaryUserInformation[] $following an array of users that follows you
     */
    private array $following = [];
    /**
     * @var NecessaryUserInformation[] $followers an array of users that you follow
     */
    private array $followers = [];
    private int $friendsCount;


    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): int
    {
        $this->id = $id;
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): string
    {
        $this->name = $name;
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): string
    {
        $this->email = $email;
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
    public function setPasswordHash(string $passwordHash): string
    {
        $this->passwordHash = $passwordHash;
        return $this->passwordHash;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate;
    }
    public function setBirthdate(string $birthdate): string
    {
        $this->birthdate = $birthdate;
        return $this->birthdate;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }
    public function setAvatar(string $avatar): string
    {
        $this->avatar = $avatar;
        return $this->avatar;
    }

    public function getCover(): string
    {
        return $this->cover;
    }
    public function setCover(string $cover): string
    {
        $this->cover = $cover;
        return $this->cover;
    }

    public function getCity(): string
    {
        return $this->city;
    }
    public function setCity(string $city): string
    {
        $this->city = $city;
        return $this->city;
    }

    public function getWork(): string
    {
        return $this->work;
    }
    public function setWork(string $work): string
    {
        $this->work = $work;
        return $this->work;
    }

    public function getFollowing(): array
    {
        return $this->following;
    }
    public function setFollowing(array $following): array
    {
        $this->following = $following;
        return $this->following;
    }

    public function getFollowers(): array
    {
        return $this->followers;
    }
    public function setFollowers(array $followers): array
    {
        $this->followers = $followers;
        return $this->followers;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }
    public function setPhotos(array $photos): array
    {
        $this->photos = $photos;
        return $this->photos;
    }

    public function getFriendsCount(): int
    {
        return $this->friendsCount;
    }
    public function setFriendsCount(int $friendsCount): int
    {
        $this->friendsCount = $friendsCount;
        return $this->friendsCount;
    }
}
