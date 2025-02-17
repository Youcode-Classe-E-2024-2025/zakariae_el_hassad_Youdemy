<?php

class TagController {

    private TagService $tagService;

    public function __construct()
    {
        $this->tagService = new TagService();
    }

    public function save()
    {
        $this->tagService->save($_POST);
        header("Location: http://localhost/zakariae_el_hassad_Youdemy/?action=tags");
        exit();
    }

    public function getAll()
    {
        $tags = $this->tagService->getAllTag();
        require_once APP_VIEWS . "toutTag.php";
    }

    public function delete() {
        if (isset($_GET['tag_id'])) {
            $tagId = $_GET['tag_id']; 
           
            $this->tagService->delete($tagId); 
        }
    
        $tags = $this->tagService->getAllTag();
        require_once APP_VIEWS . "toutTag.php";
    }
}