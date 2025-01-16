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
    
        // Création de l'objet Category avec l'image
        $category = new Category(
            name: $data["name"],
            description: $data["description"],
            admin: $admin,
            image: $data["image"] ?? null // Vérifier si une image a été fournie
        );
    
        $this->categoryDao->create($category);
    }
    

    public function categoryService()
    {
        return $this->categoryDao->getAllCategory();
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

}