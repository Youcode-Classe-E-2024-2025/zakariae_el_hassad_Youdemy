<?php

class CourseDao extends BaseDao {


    public function __construct() {
        parent::__construct("courses", Course::class);
    }

    public function getAll($limit, $offset) { 
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
        JOIN users u ON c.enseignant_id = u.id
        JOIN category ON c.category_id = category.id
        LEFT JOIN coursetags ct ON c.id = ct.course_id
        LEFT JOIN tags ON ct.tag_id = tags.id
        GROUP BY c.id
        LIMIT :limit OFFSET :offset");
    
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
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
    
    
    public function getAllByUser($userId, $limit, $offset) { 
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
        GROUP BY c.id
        LIMIT :limit OFFSET :offset");
    
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
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
        return null;
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

public function countAll() {
    $stmt = $this->connection->prepare("SELECT COUNT(*) as total FROM courses");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}


public function countByUser($userId) {
    $stmt = $this->connection->prepare("SELECT COUNT(*) FROM courses WHERE enseignant_id = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

public function searchCourses($keyword) {
    $sql = "SELECT * FROM courses WHERE name LIKE :keyword OR description LIKE :keyword";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([':keyword' => '%' . $keyword . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




        
        
}
