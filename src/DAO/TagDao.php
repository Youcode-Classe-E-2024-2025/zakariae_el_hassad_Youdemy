<?php 

class TagDao extends BaseDao {

    public function __construct()
    {
        parent::__construct("tags", Tag::class , "coursetags" );
    }

    public function getAllTagUser(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE admin_id = :id");

        $stmt->execute(["id" => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tags = [];
        foreach ($rows as $row) {
            $tag = new Tag($row["id"], $row["name"],null);
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

    public function get10tags(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE admin_id = :id ORDER BY id DESC LIMIT 6");
    
        $stmt->execute(["id" => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tags = [];
        foreach ($rows as $row) {
            $tag = new tag($row["id"], $row["name"],null);
            array_push($tags, $tag);
        }
        return $tags;
    }

    // public function delete($id){

    //     $stmt = $this->connection->prepare("DELETE FROM   WHERE tag_id = ?");
    //     $stmt->execute([$id]);

    //     $stmt = $this->connection->prepare("DELETE FROM tags WHERE id = ?");
    //     $stmt->execute([$id]);
    // }
    
}