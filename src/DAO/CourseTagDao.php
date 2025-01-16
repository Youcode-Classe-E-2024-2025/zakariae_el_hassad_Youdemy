<?php

class CourseTagDao {
    private PDO $connection;

    public function __construct()
    {
        $connectionHolder = new DatabaseConnection;
        $this->connection = $connectionHolder->connect();
    }

    public function save(int $courseId, array $tagIds)
    {
        $stmt = $this->connection->prepare("INSERT INTO coursetags (course_id, tag_id) VALUES (:course_id, :tag_id)");

        foreach($tagIds as $tagId) {
            $stmt->execute([
                "course_id" => $courseId,
                "tag_id" => $tagId
            ]);
        }
    }

    
}