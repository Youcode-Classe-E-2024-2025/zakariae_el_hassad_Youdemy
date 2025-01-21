<?php

class CategoryController {

    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    private function checkLogin()
    {
        return isset($_SESSION['logged']);
    }

    public function save() {
        $this->checkLogin();
    
        $imagePath = null;
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = "uploads/";
            $imageName = time() . "_" . basename($_FILES['image']['name']); 
            $imagePath = $uploadDir . $imageName;
    
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $_SESSION["error"] = "Erreur lors du téléchargement de l'image.";
                header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=ajout-Category");
                exit();
            }
        }
    
        $_POST['image'] = $imagePath;
    
        $this->categoryService->save($_POST);
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=tout-Category");
        exit();
    }
    
    
    

    public function getAll() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 8; 
        $offset = ($page - 1) * $limit;
    
        $categorys = $this->categoryService->categoryService($limit, $offset);
        $totalCategories = $this->categoryService->countCategories();
        $totalPages = ceil($totalCategories / $limit);
    
        require_once APP_VIEWS . "category.php";
    }
    
    public function getAll2(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 9;
        $offset = ($page - 1) * $limit;
    
        $categorys = $this->categoryService->categoryService($limit, $offset);

        $totalCategories = $this->categoryService->countCategories();
        $totalPages = ceil($totalCategories / $limit);
    
        require_once APP_VIEWS . "toutLesCategory.php";
    }

    public function get3Category()
    {
        $categorys = $this->categoryService->get3Category();
        require_once APP_VIEWS . "category.php";
    }

    public function delete() {
        if (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
            $categoryId = intval($_GET['category_id']); 
            
            if ($this->categoryService->delete($categoryId)) {
                header("Location: ?page=categories&message=deleted");
                exit();
            } else {
                header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=tout-Category");
                exit();
            }
        }
    
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=tout-Category");
        exit();
    }
}