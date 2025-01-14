<?php

class CategoryController {

    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function save(){
        $this->categoryService->save($_POST);
        header("localtion : http://localhost/zakariae_el_hassad_Youdemy/?action=category");
        exit();
    }

    public function getAll()
    {
        $categorys = $this->categoryService->categoryService();
        require_once APP_VIEWS . "category.php";
    }

    public function get3Category()
    {
        $categorys = $this->categoryService->get3Category();
        require_once APP_VIEWS . "category.php";
    }
}