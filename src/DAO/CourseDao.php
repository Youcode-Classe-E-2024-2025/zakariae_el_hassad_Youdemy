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

        $stmt = $this->connection->prepare("INSERT INTO courses (name , description , image , file , enseignant_id , category_id ) VALUES (:name , :description , :image , :file , :enseignant_id , :category_id)");
        $stmt->execute([
            "name" => $course->getName(),
            "description" => $course->getDescription(),
            "image" => $course->getImage(),
            "file" => $course->getFile(),
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
            c.image, 
            c.file, 
            u.id as user_id,
            u.name as user_name, 
            category.id as category_id,
            category.name as category_name, 
            GROUP_CONCAT(tags.name) as tag_names
        FROM courses c
        JOIN users u on c.enseignant_id = u.id
        JOIN category on c.category_id = category.id
        LEFT JOIN coursetags ct on c.id = ct.course_id
        LEFT JOIN tags on ct.tag_id = tags.id
        GROUP BY c.id");
    
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $courses = [];
        foreach ($result as $row) {
            $enseignant = new User($row['user_id'], $row['user_name']);
            $category = new Category($row['category_id'], $row['category_name']);
            $courseTags = !empty($row['tag_names']) ? explode(',', $row['tag_names']) : [];
    
            $course = new Course(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['image'],
                $row['file'], 
                $enseignant,
                $category,
                $courseTags
            );
    
            $courses[] = $course;
        }
    
        return $courses;
    }
    
    public function getAllByUser($userId) {
        $stmt = $this->connection->prepare("SELECT 
            c.id,
            c.name, 
            c.description, 
            c.image, 
            c.file, 
            u.id as user_id,
            u.name as user_name, 
            category.id as category_id,
            category.name as category_name, 
            GROUP_CONCAT(tags.name) as tag_names
        FROM courses c
        JOIN users u on c.enseignant_id = u.id
        JOIN category on c.category_id = category.id
        LEFT JOIN coursetags ct on c.id = ct.course_id
        LEFT JOIN tags on ct.tag_id = tags.id
        WHERE c.enseignant_id = :userId     
        GROUP BY c.id");
    
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $courses = [];
        foreach ($result as $row) {
            $enseignant = new User($row['user_id'], $row['user_name']);
            $category = new Category($row['category_id'], $row['category_name']);
            $courseTags = !empty($row['tag_names']) ? explode(',', $row['tag_names']) : [];
    
            $course = new Course(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['image'],
                $row['file'],
                $enseignant,
                $category,
                $courseTags
            );
    
            $courses[] = $course;
        }
    
        return $courses;
    }

    public function getCourseById($courseId) {
    $stmt = $this->connection->prepare("SELECT 
        c.id,
        c.name, 
        c.description, 
        c.image, 
        c.file, 
        u.id as user_id,
        u.name as user_name, 
        category.id as category_id,
        category.name as category_name, 
        GROUP_CONCAT(tags.name) as tag_names
    FROM courses c
    JOIN users u on c.enseignant_id = u.id
    JOIN category on c.category_id = category.id
    LEFT JOIN coursetags ct on c.id = ct.course_id
    LEFT JOIN tags on ct.tag_id = tags.id
    WHERE c.id = :courseId     
    GROUP BY c.id");

    $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return null; // Retourne null si aucun cours n'est trouvé
    }

    $enseignant = new User($row['user_id'], $row['user_name']);
    $category = new Category($row['category_id'], $row['category_name']);
    $courseTags = !empty($row['tag_names']) ? explode(',', $row['tag_names']) : [];

    return new Course(
        $row['id'],
        $row['name'],
        $row['description'],
        $row['image'],
        $row['file'],
        $enseignant,
        $category,
        $courseTags
    );
}

        
        
}
