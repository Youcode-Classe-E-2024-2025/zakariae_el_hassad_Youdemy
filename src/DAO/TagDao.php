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

    public function getAllTag(int $id)
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
}