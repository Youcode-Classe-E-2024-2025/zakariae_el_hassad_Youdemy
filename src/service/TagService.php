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
        return $this->tagDao->getAllTag();

    }

    public function getTagById(int $id): ?Tag
    {
        $tag = $this->tagDao->findById($id);

        if ($tag === null) {
            throw new Exception("Category with ID $id not found.");
        }

        return $tag;
    }

    public function get10tags()
    {
        $user = $_SESSION["user"];
        return $this->tagDao->get10tags($user->getId());
    }


}