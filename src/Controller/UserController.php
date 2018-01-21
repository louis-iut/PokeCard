<?php
/**
 * Created by PhpStorm.
 * User: louis
 * Date: 21/11/2017
 * Time: 08:10
 */

namespace App\Controller;

use Silex\Application;
use App\Entity\Pokemon;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController
{
    public function getUsers(Request $request, Application $app)
    {
        return new JsonResponse($app['repository.user']->getAll());
    }

    public function signup(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        $user = $app['repository.user']->insert($parameters['facebook_id'], $parameters['pseudo']);
        $content = json_encode($user);
        $statusCode = 200;

        return new Response($content, $statusCode, ['Content-type' => 'application/json']);
    }

    public function login(Request $request, Application $app) {

        $parameters = json_decode(file_get_contents('php://input'), true);
        var_dump($parameters);
        die();
        $user = $app['repository.user']->getByEmail($parameters['email']);
        die();
    }


    public function addPokemonAction(Request $request, Application $app) {

        $parameters = $request->attributes->all();
        $association = $app['repository.user']->insert($parameters['userID'], $parameters['pokemonID']);

        $statutCode = 200;
        $content = json_encode(array('message' => 'pokemon added'));
        return new Response($content, $statutCode ,['Content-type' => 'application/json']);
    }

    public function getPokemons(Request $request, Application $app) {

        $parameters = $request->attributes->all();
        $pokemons = $app['repository.user']->getPokemons($parameters['userID']);

        $pokemonsArray = array();
        foreach ($pokemons as $pokemon) {
            $newPokemon = $app['repository.pokemon']->getById($pokemon['pokemonID'], "en");
            array_push($pokemonsArray, $newPokemon->toArray());

        }

        $statutCode = 200;
        $content = json_encode($pokemonsArray);
        return new Response($content, $statutCode ,['Content-type' => 'application/json']);
    }

}
