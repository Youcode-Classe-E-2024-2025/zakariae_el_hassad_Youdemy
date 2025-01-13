<?php

class Tag
{
    private int $id;
    private string $name;
    public ?User $admin;

    public function __construct(int $id = 0, string $name = "", ?User $admin = null)
    {
        $this->id = $id;
        $this->name = $name;
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

    public function getProjectManager(): User
    {
        return $this->admin;
    }
    public function setProjectManager(User $admin): void
    {
        $this->admin = $admin;
    }
}
