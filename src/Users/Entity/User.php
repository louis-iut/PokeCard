<?php

namespace App\Users\Entity;

class User
{
    protected $id;

    protected $lastname;

    protected $firstname;

    public function __construct($id, $lastname, $firstname)
    {

        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;  

    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['lastname'] = $this->lastname;
        $array['firstname'] = $this->firstname;

        return $array;
    }
}
