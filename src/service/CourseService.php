<?php

class CourseService{
    private CourseDao $courseDao;
    private CourseTagDao $courseTagDao;
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->courseDao = new CourseDao();
        $this->courseTagDao = new CoursetagDao();
        $this->categoryService = new CategoryService();
    }

    public function save(array $data){


        $category = $this->categoryService->getCategoryById((int)$data["isCategory"]);
        $enseignant = new User();
        $user = $_SESSION["user"];
        $enseignant->setId($user->getId());
        
       
        $course = new Course(
            name : $data["name"],
            description : $data["description"],
            image: $data["image"] ?? null ,
            file: $data["file"] ?? null,
            enseignant : $enseignant,
            category : $category,
        );

        $courseId = $this->courseDao->create($course);
        $this->courseTagDao->save($courseId, $data["tags"]);
    }

    public function getAll($limit, $offset) { 
        return $this->courseDao->getAll($limit, $offset);
    }
    
    public function countAll() {
        return $this->courseDao->countAll();
    }
    
    public function getAllByUser($userId, $limit, $offset) {
        return $this->courseDao->getAllByUser($userId, $limit, $offset);
    }
    
    public function countByUser($userId) {
        return $this->courseDao->countByUser($userId);
    }
    

    public function getCourseById($courseId) {
        return $this->courseDao->getCourseById($courseId);
    }
    
    public function delete($id) {
        return $this->courseDao->delete($id);
    }


    public function getCoursesByCategoryWithPagination(int $categoryId, int $limit, int $offset): array {
        return $this->courseDao->getCoursesByCategoryWithPagination($categoryId, $limit, $offset);
    }
    
    public function countByCategory(int $categoryId): int {
        return $this->courseDao->countByCategory($categoryId);
    }
    


    
    
}