<?php 

class CategoryService{
    private CategoryDao $categoryDao;

    public function __construct()
    {
        $this->categoryDao = new categoryDao();
    }

    public function save(array $data) {
        $admin = new User();
        $user = $_SESSION["user"];
        $admin->setId($user->getId());
    
        $category = new Category(
            name: $data["name"],
            description: $data["description"],
            admin: $admin,
            image: $data["image"] ?? null 
        );
    
        $this->categoryDao->create($category);
    }
    

    public function categoryService(int $limit, int $offset) {
        return $this->categoryDao->getPaginatedCategories($limit, $offset);
    }
    
    public function countCategories() {
        return $this->categoryDao->countCategories();
    }
    

    public function getCategoryById(int $id): ?Category
    {
        $category = $this->categoryDao->findById($id);

        if ($category === null) {
            throw new Exception("Category with ID $id not found.");
        }

        return $category;
    }

    public function get3Category()
    {
        $user = $_SESSION["user"];
        return $this->categoryDao->get3Category($user->getId());
    }

    public function delete($id) {
        return $this->categoryDao->delete($id);
    }

}


