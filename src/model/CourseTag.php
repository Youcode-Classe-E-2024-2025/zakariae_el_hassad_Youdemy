<?php 

class CourseTag {
    private int $id;
    public ?Course $course;
    public ?Tag $tag;
    
    public function __construct(int $id , ?Course $course , ?Tag $tag)
    {
        $this->id = $id;
        $this->course = $course;
        $this->tag = $tag;
    }

    public function getId():int{
        return $this->id;
    }
    public function setId(int $id):void{
        $this->id = $id;
    }

    public function getCourse(): Course {
       return $this->course;
    }
    public function setCourse(Course $course) : void {
        $this->course = $course ;
    }

    public function getTag(): Tag {
        return $this->tag;
     }
     public function setTag(Tag $tag) : void {
         $this->tag = $tag ;
     }
}