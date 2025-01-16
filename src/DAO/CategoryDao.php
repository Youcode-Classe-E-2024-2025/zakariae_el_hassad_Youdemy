<?php 

class CategoryDao {
    private PDO $connection ;

    public function __construct()
    {
        $connectionHolder = new DatabaseConnection; 
        $this->connection = $connectionHolder->connect();
    }

    public function create(Category $category){

        $stmt = $this->connection->prepare("INSERT INTO category (name , description , admin_id) VALUES (:name , :description , :admin_id)");
        return $stmt->execute([
            "name" => $category->getName(),
            "description" => $category->getDescription(),
            "admin_id" => $category->getAdmin()->getId()
        ]);
    }


    public function getAllCategory(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM category WHERE admin_id = :id");

        $stmt->execute(["id" => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Categorys = [];
        foreach ($rows as $row) {
            $Category = new category($row["id"], $row["name"], $row["description"],null);
            array_push($Categorys, $Category);
        }
        return $Categorys;
    }

    public function findById(int $id): ?Category
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT c.id AS category_id, c.name AS category_name, c.description AS category_description, 
                       u.id AS admin_id, u.name AS user_name, u.email AS user_email
                FROM category c
                LEFT JOIN users u ON c.admin_id = u.id
                WHERE c.id = :id
            ");
    
            if (!$stmt) {
                die('SQL Error: ' . implode(":", $this->connection->errorInfo()));
            }
    
            $stmt->execute(['id' => $id]);
            $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($categoryData) {
                $admin = null;
    
                if ($categoryData['admin_id']) {
                    $admin = new User(
                        id: (int)$categoryData['admin_id'],
                        name: $categoryData['user_name'],
                        email: $categoryData['user_email']
                    );
                }
    
                return new Category(
                    id: (int)$categoryData['category_id'],
                    name: $categoryData['category_name'],
                    description: $categoryData['category_description'],
                    admin: $admin
                );
            }
    
            return null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    public function get3Category(int $id)
{
    // SQL query bach tsift ghir 3 dial les catégories li dkhlo dernier
    $stmt = $this->connection->prepare("SELECT * FROM category WHERE admin_id = :id ORDER BY id DESC LIMIT 3");

    $stmt->execute(["id" => $id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $Categorys = [];
    foreach ($rows as $row) {
        $Category = new category($row["id"], $row["name"], $row["description"], null);
        array_push($Categorys, $Category);
    }
    return $Categorys;
}




}