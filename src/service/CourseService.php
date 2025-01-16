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
            enseignant : $enseignant,
            categoryId : $category,
        );

        $courseId = $this->courseDao->create($course);
        $this->courseTagDao->save($courseId, $data["tags"]);
    }

    public function getAll(){
        return $this->courseDao->getAll();
    }

    public function getAllByUser($userId) {
        return $this->courseDao->getAllByUser($userId);
    }
    
    
}