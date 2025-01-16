<?php

class CourseDao
{
    private PDO $connection;

    public function __construct()
    {
        $connectionHolder = new DatabaseConnection;
        $this->connection = $connectionHolder->connect();
    }

    public function create(Course $course)
    {

        $stmt = $this->connection->prepare("INSERT INTO courses (name , description , enseignant_id , category_id ) VALUES (:name , :description , :enseignant_id , :category_id)");
        $stmt->execute([
            "name" => $course->getName(),
            "description" => $course->getDescription(),
            "enseignant_id" => $course->getEnseignant()->getId(),
            "category_id" => $course->getCategoryId()->getId(),
        ]);
        return $this->connection->lastInsertId();
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT 
            c.id,
            c.name, 
            c.description, 
            u.id as user_id,
            u.name as user_name, 
            category.id as category_id,
            category.name as category_name, 
            GROUP_CONCAT(tags.name) as tag_names
        FROM courses c
        JOIN users u on c.enseignant_id = u.id
        JOIN category on c.category_id = category.id
        JOIN coursetags ct on c.id = ct.course_id
        JOIN tags on ct.tag_id = tags.id
        GROUP BY c.id");
    
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // تحويل النتيجة إلى كائنات
        $courses = [];
        foreach ($result as $row) {
            // إنشاء كائنات User و Category
            $enseignant = new User($row['user_id'], $row['user_name']);
            $category = new Category($row['category_id'], $row['category_name']);
            $courseTags = explode(',', $row['tag_names']); // تحويل الأوسمة إلى مصفوفة
    
            // إنشاء كائن Course
            $course = new Course(
                $row['id'],
                $row['name'],
                $row['description'],
                $enseignant,
                $category,
                $courseTags
            );
    
            $courses[] = $course;
        }
    
        return $courses;
    }
        
}
