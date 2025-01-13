<?php 

class CategoryService{
    private CategoryDao $categoryDao;

    public function __construct()
    {
        $this->categoryDao = new categoryDao();
    }

    public function save(array $data){

        $admin = new User();
        $user = $_SESSION["user"];
        $admin->setId($user->getId());
        
        $category = new Category(
            name : $data["name"],
            description : $data["description"],
            admin : $admin
        );

        $this->categoryDao->create($category);
    }
}