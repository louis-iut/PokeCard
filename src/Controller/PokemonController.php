<?php

namespace App\Controller;

use Silex\Application;
use App\Entity\Pokemon;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PokemonController
{

    public function getPokemons(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $page = $_GET['page'];
        $pokemons = $app['repository.pokemon']->getAll();
        $statutCode = 200;
        $pokemonArray = array();

        $maxPokemon = 20;

        for ($i=($maxPokemon*$page); $i < ($maxPokemon*$page)+20; $i++) { 

            $pokemonID = $pokemons[$i]['entry_number'];
            $pokemonName = $pokemons[$i]['pokemon_species']['name'];
            $pokemonImageURL = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$pokemonID}.png";
            $pokemonDetailsRoute = "pokecard.local/index.php/en/pokemon/{$pokemonID}";

             $newPokemon = new Pokemon($pokemonID, $pokemonName, $pokemonImageURL, $pokemonDetailsRoute);
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
