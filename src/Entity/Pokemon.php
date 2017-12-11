<?php

namespace App\Entity;

class Pokemon
{
    protected $id;
    protected $name;
    protected $imageUrl;
    protected $detailsRoute;

    /**
     * Pokemon constructor.
     * @param $id
     * @param $name
     * @param $imageUrl
     */
    public function __construct($id, $name, $imageUrl, $detailsRoute)
    {
        $this->id = $id;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->detailsRoute = $detailsRoute;
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
    public function getDetailsRoute()
    {
        return $this->detailsRoute;
    }

    /**
     * @param mixed $name
     */
    public function setDetailsRoute($detailsRoute)
    {
        $this->detailsRoute = $detailsRoute;
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

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['name'] = $this->name;
        $array['imageURL'] = $this->imageUrl;
        $array['detailsRoute'] = $this->detailsRoute;

        return $array;
    }
}
