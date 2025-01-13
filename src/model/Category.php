<?php

class Category
{
    private int $id;
    private string $name;
    private string $description;
    public ?User $admin;

    public function __construct(int $id = 0, string $name = "", string $description = "", ?User $admin = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->admin = $admin;
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

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getAdmin(): User
    {
        return $this->admin;
    }
    public function setAdmin(User $admin): void
    {
        $this->admin = $admin;
    }
}
