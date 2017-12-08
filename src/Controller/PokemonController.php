<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PokemonController
{

    public function getPokemons(Request $request, Application $app){

        $pokemons = $app['repository.pokemon']->getAll();
        $content = json_encode($pokemons);
        $statutCode = 200;

        return new Response($content, $statutCode ,['Content-type' => 'application/json']);
    }

    public function getPokemonWithID(Request $request, Application $app){

        $parameters = $request->attributes->all();
        $pokemons = $app['repository.pokemon']->getById($parameters['id']);
        $content = json_encode($pokemons);
        $statutCode = 200;

        return new Response($content, $statutCode ,['Content-type' => 'application/json']);
    }


}
