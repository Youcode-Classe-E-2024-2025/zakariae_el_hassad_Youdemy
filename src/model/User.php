<?php

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private ?string $image;
    private ?Role $role;
    private int $active;

    public function __construct(int $id = 0, string $name = "", string $email = "", string $password = "", ?string $image = null , ?Role $role = null , int $active = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->role = $role;
        $this->active = $active;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getImage(): string {
        return $this->image ?: "uploads/default.jpg"; 
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }
}
