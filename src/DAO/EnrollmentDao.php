<?php

class EnrollmentDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("enrollment", Enrollment::class);
    }
}
