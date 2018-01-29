<?php

namespace App\Entity;

class Exchange
{

    protected $id;
    protected $userID;
    protected $firstPokemonID;
    protected $secondPokemonID;
    protected $date;

    public function __construct($id, $userID, $firstPokemonID, $secondPokemonID, $date)
    {
        $this->id = $id;
        $this->userID = $userID;
        $this->firstPokemonID = $firstPokemonID;
        $this->secondPokemonID = $secondPokemonID;
        $this->date = $date;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['userID'] = $this->userID;
        $array['firstPokemonID'] = $this->firstPokemonID;
        $array['secondPokemonID'] = $this->secondPokemonID;
        $array['date'] = $this->date;

        return $array;
    }
}

