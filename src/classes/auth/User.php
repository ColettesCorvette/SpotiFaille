<?php

namespace iutnc\deefy\auth;

class User
{
    private int $id;
    private string $email;
    private string $role;

    public function __construct(int $id, string $email, string $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}