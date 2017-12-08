<?php

namespace App\Controller;

use Silex\Application;
use App\Entity\Pokemon;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PokemonController
{

    public function getPokemonsWithoutCode(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();

        $pokemons = $app['repository.pokemon']->getAll();
        $statutCode = 200;
        $pokemonArray = array();
    
        foreach ($pokemons as $pokemon) {

            $pokemonID = $pokemon['entry_number'];
            $pokemonName = $pokemon['pokemon_species']['name'];
            $pokemonImageURL = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$pokemon['entry_number']}.png";

            $newPokemon = new Pokemon($pokemonID, $pokemonName, $pokemonImageURL);
            array_push($pokemonArray, $newPokemon->toArray()); 
        }
            $content = json_encode($pokemonArray);
            return new Response($content, $statutCode ,['Content-type' => 'application/json']); 
    }

    public function getPokemons(Request $request, Application $app){

        $parameters = $request->attributes->all();

        $pokemons = $app['repository.pokemon']->getAll();
        $statutCode = 200;
        $pokemonArray = array();
    
        foreach ($pokemons as $pokemon) {

            $newPokemon = $app['repository.pokemon']->getById($pokemon['entry_number'], $parameters['code']);
            array_push($pokemonArray, $newPokemon->toArray()); 
        }

        $content = json_encode($pokemonArray);
        return new Response($content, $statutCode ,['Content-type' => 'application/json']); 
    }

    public function getPokemonsID(Request $request, Application $app){

        $pokemons = $app['repository.pokemon']->getAllID();
        $content = json_encode($pokemons);
        $statutCode = 200;

        return new Response($content, $statutCode ,['Content-type' => 'application/json']);
    }

    public function getPokemonWithID(Request $request, Application $app){

        $parameters = $request->attributes->all();
        $pokemons = $app['repository.pokemon']->getById($parameters['id'], $parameters['code']);
        $content = json_encode($pokemons->toArray());
        $statutCode = 200;

        return new Response($content, $statutCode ,['Content-type' => 'application/json']);
    }


}
