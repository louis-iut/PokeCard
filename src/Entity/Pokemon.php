<?php

namespace App\Entity;

class User
{
    protected $id;
    protected $name;
    protected $imageUrl;

    /**
     * User constructor.
     * @param $id
     * @param $name
     * @param $imageUrl
     */
    public function __construct($id, $name, $imageUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }
}
