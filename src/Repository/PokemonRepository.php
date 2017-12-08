<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;

/**
 * Pokemon repository.
 */

 use Symfony\Component\HttpFoundation\Response;
 
class PokemonRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   public function getAll()
   {

        $json_url = "https://pokeapi.co/api/v2/pokedex/1/";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);

        $pokemonList = $data['pokemon_entries'];
        
       return $pokemonList;
   }

   public function getById($id) {
 
       $json_url = "https://pokeapi.co/api/v2/pokemon-species/{$id}/";
       $json = file_get_contents($json_url);
       $data = json_decode($json, TRUE);

       $pokemonID = $data['id'];
       $pokemonNames = $data['names'];

       var_dump($pokemonNames); die;

   }

    public function getPokemonWithURL($url)
   {
       $json_url = $url;
       $json = file_get_contents($json_url);
       $data = json_decode($json, TRUE);

       $pokemonID = $data['id'];
       $pokemonNames = $data['names'];

       var_dump($pokemonNames); die;

       //return $newPokemon;
   }
}

