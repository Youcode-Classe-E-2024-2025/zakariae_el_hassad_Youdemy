<?php 

class CategoryDao {
    private PDO $connection ;

    public function __construct()
    {
        $connectionHolder = new DatabaseConnection; 
        $this->connection = $connectionHolder->connect();
    }

    public function create(Category $category){

        $stmt = $this->connection->prepare("INSERT INTO ctaegory (name , description , admin_id) VALUES (:name , :description , :admin_id)");
        return $stmt->execute([
            "name" => $category->getName(),
            "description" => $category->getDescription(),
            "admin_id" => $category->getAdmin()
        ]);
    }
}