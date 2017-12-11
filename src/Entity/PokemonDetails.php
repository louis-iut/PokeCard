<?php

namespace App\Entity;

class PokemonDetails
{
    protected $id;
    protected $name;
    protected $imageUrl;
    protected $habitat;
    protected $color;
    protected $description;

    /**
     * Pokemon constructor.
     * @param $id
     * @param $name
     * @param $imageUrl
     */
    public function __construct($id, $name, $imageUrl, $habitat, $color, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->habitat = $habitat;
        $this->color = $color;
        $this->description = $description;

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

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['name'] = $this->name;
        $array['imageURL'] = $this->imageUrl;
        $array['habitat'] = $this->habitat;
        $array['color'] = $this->color;
        $array['description'] = $this->description;

        return $array;
    }
}
