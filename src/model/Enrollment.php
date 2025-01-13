<?php 

class Enrollment {
    private int $id;
    private DateTime $enrollmentDate;

    public function __construct(int $id , DateTime $enrollmentDate)
    {
        $this->id = $id;
        $this->enrollmentDate= $enrollmentDate;
    }

    public function getId():int{
        return $this->id;
    }
    public function setID(int $id):void {
        $this->id = $id ;
    }

    public function getEnrollmentDate():DateTime {
        return $this->enrollmentDate;
    }
    public function setEnrollmentDtae(DateTime $enrollmentDate) :void {
        $this->enrollmentDate = $enrollmentDate ;
    }
}