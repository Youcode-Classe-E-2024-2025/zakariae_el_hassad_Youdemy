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
        $this->courseService->save($_POST);
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=course");
        exit();
    }

    public function getAll()
    {

        $courses = $this->courseService->getAll();
        $tags = $this->tagService->getAllTag();
        $categorys = $this->categoryService->categoryService();
        require_once APP_VIEWS . "course.php";
    }

}