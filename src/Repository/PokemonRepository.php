<?php

namespace App\Repository;

use App\Entity\Pokemon;
use App\Entity\PokemonDetails;
use Doctrine\DBAL\Connection;

/**
 * Pokemon repository.
 */
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

    public function getAllID()
    {

        $json_url = "https://pokeapi.co/api/v2/pokedex/1/";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);

        $pokemonList = $data['pokemon_entries'];

        $pokemonIDArray = array();

        foreach ($pokemonList as $pokemon) {
            array_push($pokemonIDArray, $pokemon['entry_number']);
        }

        return $pokemonIDArray;
    }

    public function getDetailsById($id, $code)
    {
        $json_url = "https://pokeapi.co/api/v2/pokemon-species/{$id}/";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);

        $pokemonID = $data['id'];
        $pokemonNames = $data['names'];
        $habitat = $data['habitat']['name'];
        $color = $data['color']['name'];
        $description = $this->getDescription($data, $code);

        $pokemonImageURL = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$id}.png";

        foreach ($pokemonNames as $pokemonName) {
            if ($pokemonName["language"]["name"] == $code) {
                $selectedPokemonName = $pokemonName["name"];
            }
        }

        $newPokemon = new PokemonDetails($pokemonID, $selectedPokemonName, $pokemonImageURL, $habitat, $color, $description);
        return $newPokemon;
    }

    public function getById($id)
    {
        $pokemonList = $this->getAll();

        if(!isset($pokemonList[$id])) {
            return null;
        }

        $pokemonID = $pokemonList[$id-1]['entry_number'];
        $pokemonName = $pokemonList[$id-1]['pokemon_species']['name'];
        $pokemonImageURL = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$pokemonID}.png";
        $pokemonDetailsRoute = "pokecard.local/index.php/en/pokemon/{$pokemonID}";
        $newPokemon = new Pokemon($pokemonID, $pokemonName, $pokemonImageURL, $pokemonDetailsRoute);

        return $newPokemon;
    }

    public function getDescription($json, $code)
    {
        $descriptions = $json['flavor_text_entries'];
        foreach ($descriptions as $description) {
            if ($description['language']['name'] == $code) {
                return $description['flavor_text'];
            }
        }
    }
}

