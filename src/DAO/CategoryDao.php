<?php 

class CategoryDao {
    private PDO $connection ;

    public function __construct()
    {
        $connectionHolder = new DatabaseConnection; 
        $this->connection = $connectionHolder->connect();
    }

    public function create(Category $category){

        $stmt = $this->connection->prepare("INSERT INTO ctaegory (name , description) VALUES (:name , :description)");
        return $stmt->execute([
            "name" => $category->getName(),
            "description" => $category->getDescription()
        ]);
    }
}