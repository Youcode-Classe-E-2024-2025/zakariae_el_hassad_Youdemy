<?php 

class TagService{
    private TagDao $tagDao;

    public function __construct()
    {
        $this->tagDao = new TagDao();
    }

    public function save(array $data){

        
        $admin = new User();
        $user = $_SESSION["user"];
        $admin->setId($user->getId());
        
       
        $tag = new Tag(
            name : $data["name"],
            admin : $admin
        );

        $this->tagDao->create($tag);
    }

    public function getAllTag()
    {
        $user = $_SESSION["user"];
        return $this->tagDao->getAllTag($user->getId());

    }


}