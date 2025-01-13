<?php

class CategoryController {

    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function save(){
        $this->categoryService->save($_POST);
        header("localtion : http://localhost/zakariae_el_hassad_Youdemy/?action=save_category");
        exit();
    }

    public function getAll()
    {
        require_once APP_VIEWS . "category.php";
    }
}