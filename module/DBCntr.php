<?php

class DBCntr
{
    public $dbcntr;
    public function __construct($dbcntr)
    {
        $this->dbcntr = $dbcntr;
    }
    public function read()
    {
        return $this->dbcntr->query('SELECT * FROM Stud')->fetchAll();
    }

}