<?php

namespace App\Entity;

class User
{
    protected $id;

    protected $facebookId;

    protected $pseudo;

    /**
     * User constructor.
     * @param $id
     * @param $facebookId
     * @param $pseudo
     */
    public function __construct($id, $facebookId, $pseudo)
    {
        $this->id = $id;
        $this->facebookId = $facebookId;
        $this->pseudo = $pseudo;
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
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param mixed $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }




}
