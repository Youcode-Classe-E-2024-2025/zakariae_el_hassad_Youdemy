<?php 

class TagDao {
    private PDO $connection ;

    public function __construct()
    {
        $connectionHolder = new DatabaseConnection; 
        $this->connection = $connectionHolder->connect();
    }

    public function create(Tag $tag){

        $stmt = $this->connection->prepare("INSERT INTO tags (name , admin_id) VALUES (:name , :admin_id)");
        return $stmt->execute([
            "name" => $tag->getName(),
            "admin_id" => $tag->getAdmin()->getId()
        ]);
    }

    public function getAllTagUser(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE admin_id = :id");

        $stmt->execute(["id" => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tags = [];
        foreach ($rows as $row) {
            $tag = new tag($row["id"], $row["name"],null);
            array_push($tags, $tag);
        }
        return $tags;
    }

    public function getAllTag()
    {
        $stmt = $this->connection->prepare("SELECT * FROM tags");

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tags = [];
        foreach ($rows as $row) {
            $tag = new tag($row["id"], $row["name"],null);
            array_push($tags, $tag);
        }
        return $tags;
    }

    public function findById(int $id): ?Tag
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT t.id AS tag_id, t.name AS tag_name, 
                       u.id AS admin_id, u.name AS user_name, u.email AS user_email
                FROM tags t
                LEFT JOIN users u ON t.amin_id = u.id
                WHERE t.id = :id
            ");
    
            if (!$stmt) {
                die('SQL Error: ' . implode(":", $this->connection->errorInfo()));
            }
    
            $stmt->execute(['id' => $id]);
            $tagData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($tagData) {
                $admin = null;
    
                if ($tagData['admin_id']) {
                    $admin = new User(
                        id: (int)$tagData['admin_id'],
                        name: $tagData['user_name'],
                        email: $tagData['user_email']
                    );
                }
    
                return new Tag(
                    id: (int)$tagData['tag_id'],
                    name: $tagData['tag_name'],
                    admin: $admin
                );
            }
    
            return null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
}