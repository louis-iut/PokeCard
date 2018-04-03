<?php
/**
 * Created by PhpStorm.
 * User: louis
 * Date: 21/11/2017
 * Time: 08:10
 */

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController
{
    public function getUsers(Request $request, Application $app)
    {
        return new JsonResponse($app['repository.user']->getAll());
    }

    public function signUp(Request $request, Application $app)
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
        $parameters = $request->request->all();

        $user = $app['repository.user']->getByFacebookId($parameters['facebook_id']);
        if ($user) {
            $content = "facebook_id already exist in DB";
            $statusCode = 501;

            return new Response($content, $statusCode, array($statusCode, $content));
        }

        $user = $app['repository.user']->getByPseudo($parameters['pseudo']);
        if ($user) {
            $content = "pseudo already exist in DB";
            $statusCode = 502;

            return new Response($content, $statusCode, array($statusCode, $content));
        }

        $user = $app['repository.user']->insertUser($parameters['facebook_id'], $parameters['pseudo']);
        $content = json_encode($user);
        $statusCode = 200;

        $pokemonIds = $app['repository.pokemon']->getAllID();
        $lastID = intval(end($pokemonIds));

        for ($i=0; $i < 10; $i++) { 
            $pokemonId = rand(1, $lastID);
            $app['repository.user']->insertPokemon($user["id"], $pokemonId);
        }

        return new Response($content, $statusCode, ['Content-type' => 'application/json']);
    }

    public function signIn(Request $request, Application $app)
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
        $parameters = $request->request->all();
        $user = $app['repository.user']->getByFacebookId($parameters['facebook_id']);

        if (!$user) {
            $content = "Error authentication";
            $statusCode = 401;

            return new Response($content, $statusCode, array($statusCode, $content));
        }


        $content = json_encode($user);
        $statusCode = 200;

        return new Response($content, $statusCode, ['Content-type' => 'application/json']);
    }


    public function addPokemonAction(Request $request, Application $app)
    {

        $parameters = $request->attributes->all();
        $association = $app['repository.user']->insertPokemon($parameters['userID'], $parameters['pokemonID']);

        $statutCode = 200;
        $content = json_encode(array('message' => 'pokemon added'));
        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }

    public function getPokemons(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();

        $pokemons = $app['repository.user']->getPokemons($parameters['userID']);
        $pokemonsArray = array();

        foreach ($pokemons as $pokemon) {
            
            $newPokemon = $app['repository.pokemon']->getById($pokemon['pokemon_id'], "en");
            
            if ($newPokemon != NULL) {
                $serializablePokemon = $newPokemon->toArray();
                array_push($pokemonsArray, $serializablePokemon);
            }
        }

        $statutCode = 200;
        $content = json_encode($pokemonsArray);
        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }

}
