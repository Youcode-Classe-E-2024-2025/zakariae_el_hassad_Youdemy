<?php

class EnrollmentDao {
    private PDO $connection;

    public function __construct()
    {
        $connectionHolder = new DatabaseConnection;
        $this->connection = $connectionHolder->connect();
    }

    public function save(int $userId, array $courseIds)
    {
        $stmt = $this->connection->prepare("INSERT INTO coursetags (student_id, course_id , enrollment_date) VALUES (:student_id, :course_id , :enrollment_date)");

        foreach($courseIds as $courseId) {
            $stmt->execute([
                "student_id" => $userId,
                "course_id" => $courseId,
            ]);
        }
    }
}
