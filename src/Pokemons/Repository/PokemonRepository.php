<?php

namespace App\Pokemons\Repository;

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

   /**
    * Returns a collection of users.
    * @param int $limit
    *   The number of users to return.
    * @param int $offset
    *   The number of users to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    * @return array A collection of users, keyed by user id.
    */
    
   public function getAll()
   {

        $json_url = "https://pokeapi.co/api/v2/pokedex/1/";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);

        $pokemonList = $data['pokemon_entries'];
        
       return $pokemonList;
   }
}

