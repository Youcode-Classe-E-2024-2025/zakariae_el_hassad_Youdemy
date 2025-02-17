<?php 

class CourseController{
    private CourseService $courseService;
    private TagService $tagService;
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->courseService = new CourseService();
        $this->tagService = new TagService();
        $this->categoryService = new CategoryService();
    }

    private function checkLogin()
    {
        return isset($_SESSION['logged']);
    }

    public function save(){
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

        $filePath = null;

    if (!empty($_FILES['file']['name'])) {
        $uploadDir = "uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES['file']['name']); 
        $filePath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            $_SESSION["error"] = "Erreur lors du téléchargement du fichier.";
            header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=ajout-Category");
            exit();
        }
    }

    $_POST['file'] = $filePath;


        $this->courseService->save($_POST);
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=ton_course");
        exit();
    }

    public function getAll() {
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        $courses = $this->courseService->getAll($limit, $offset);
        $tags = $this->tagService->getAllTag();
        $categories = $this->categoryService->categoryService($limit, $offset);
        
        $totalCourses = $this->courseService->countAll();
        $totalPages = ceil($totalCourses / $limit);
    
        require_once APP_VIEWS . "course.php";
    }
    

    public function getAllByUser() {
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        $userId = $_SESSION['user']->getId();  
        $courses = $this->courseService->getAllByUser($userId, $limit, $offset);
        $tags = $this->tagService->getAllTag();
        $categorys = $this->categoryService->categoryService($limit, $offset);
    
        $totalCourses = $this->courseService->countByUser($userId);
        $totalPages = ceil($totalCourses / $limit);
    
        require_once APP_VIEWS . "tonCourse.php";
    }
    

    public function showCourseDetail() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            die("ID du cours manquant.");
        }
    
        $courseId = (int) $_GET['id'];
        $course = $this->courseService->getCourseById($courseId);
    
        if (!$course) {
            die("Cours non trouvé.");
        }
  
        require_once APP_VIEWS . "detailCourse.php";
    }

    public function delete() {
        if (isset($_GET['course_id'])) {
            $courseId = (int)$_GET['course_id']; 
    
            $this->courseService->delete($courseId); 
        }
    
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        $userId = $_SESSION['user']->getId();
        $courses = $this->courseService->getAllByUser($userId, $limit, $offset);
        $tags = $this->tagService->getAllTag();
        $categories = $this->categoryService->categoryService($limit, $offset);
    
        $totalCourses = $this->courseService->countByUser($userId);
        $totalPages = ceil($totalCourses / $limit);
    
        require_once APP_VIEWS . "tonCourse.php";
    }
    
    public function showCoursesByCategory() {
        if (!isset($_GET['category_id']) || !is_numeric($_GET['category_id'])) {
            die("Catégorie invalide.");
        }
    
        $categoryId = (int) $_GET['category_id'];
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        try {
            $courses = $this->courseService->getCoursesByCategoryWithPagination($categoryId, $limit, $offset);
            $totalCourses = $this->courseService->countByCategory($categoryId);
            $totalPages = ceil($totalCourses / $limit);
    
            require_once APP_VIEWS . "table.php";
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
    


}