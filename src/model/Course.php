<?php

class Course
{
    private int $id;
    private string $name;
    private string $description;
    private ?string $image;
    private ?string $file;
    public ?User $enseignant;
    public ?Category $category;
    public ?array $courseTags;
    private ?Media $contenu;

    public function __construct(int $id = 0, string $name = "", string $description = "", ?string $image = null ,?string $file = null,  ?User $enseignant = null, ?Category $category = null, ?array $courseTags = null,  ?Media $contenu = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->file = $file;
        $this->enseignant = $enseignant;
        $this->category = $category;
        $this->courseTags = $courseTags;
        $this->contenu = $contenu;
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

    public function getImage(): ?string {
        return $this->image;
    }

    public function setImage(?string $image): void {
        $this->image = $image;
    }

    public function getFile(): ?string {
        return $this->file;
    }

    public function setFile(?string $file): void {
        $this->file = $file;
    }

    public function getEnseignant(): User
    {
        return $this->enseignant;
    }
    public function setEnseignant(User $enseignant): void
    {
        $this->enseignant = $enseignant;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getCourseTags(): array
    {
        return $this->courseTags;
    }
    public function setCourseTags(array $courseTags): void
    {
        $this->courseTags = $courseTags;
    }

    public function getContenu(): Media
    {
        return $this->contenu;
    }
    public function setContenu(Media $contenu): void
    {
        $this->contenu = $contenu;
    }
}
