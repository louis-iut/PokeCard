<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PokemonController
{

    public function getPokemons(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $page = $_GET['page'];
        $maxPokemon = $_GET['number'];

        $pokemons = $app['repository.pokemon']->getAll();
        $statutCode = 200;
        $pokemonArray = array();

        for ($i = ($maxPokemon * $page); $i < ($maxPokemon * ($page + 1)); $i++) {
            if (!empty($pokemons[$i])) {

                $pokemonID = $pokemons[$i]['entry_number'];
                $pokemonName = $pokemons[$i]['pokemon_species']['name'];
                $pokemonImageURL = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$pokemonID}.png";
                $pokemonDetailsRoute = "pokecard.local/index.php/en/pokemon/{$pokemonID}";
                $newPokemon = new Pokemon($pokemonID, $pokemonName, $pokemonImageURL, $pokemonDetailsRoute);
                array_push($pokemonArray, $newPokemon->toArray());

            } else {
                break;
            }
        }

        $content = json_encode($pokemonArray);
        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }


    public function getPokemonsID(Request $request, Application $app)
    {

        $pokemons = $app['repository.pokemon']->getAllID();
        $content = json_encode($pokemons);
        $statutCode = 200;

        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }

    public function getPokemonWithID(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $pokemons = $app['repository.pokemon']->getDetailsById($parameters['id'], $parameters['code']);
        $content = json_encode($pokemons->toArray());
        $statutCode = 200;

        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }


}
