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

    public function save(){
        $this->checkLogin();
        $this->categoryService->save($_POST);
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=category");
        exit();
    }

    public function getAll()
    {
        $categorys = $this->categoryService->categoryService();
        require_once APP_VIEWS . "category.php";
    }

    public function getAll2()
    {
        $categorys = $this->categoryService->categoryService();
        require_once APP_VIEWS . "toutLesCategory.php";
    }

    public function get3Category()
    {
        $categorys = $this->categoryService->get3Category();
        require_once APP_VIEWS . "category.php";
    }
}