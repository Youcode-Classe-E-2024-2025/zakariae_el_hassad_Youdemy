<?php

class Course {
    private int $id;
    private string $name;
    private string $description;
    private ?Media $contenu;

    public function __construct(int $id=0 ,string $name ="" , string $description="" , ?Media $contenu )
    {
        $this->id = $id ;
        $this->name = $name ;
        $this->description = $description ;
        $this->contenu = $contenu ;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getContenu() : Media{
        return $this->contenu;
    }
    public function setContenu(Media $contenu):void{
        $this->contenu = $contenu;
    }

}