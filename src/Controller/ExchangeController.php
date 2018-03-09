<?php

namespace App\Controller;

use Silex\Application;
use App\Entity\Pokemon;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExchangeController
{

    public function getExchanges(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $exchanges = $app['repository.exchange']->getAll();
        $content = json_encode($exchanges);
        $statutCode = 200;

        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }

    public function getExchangeWithID(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $exchange = $app['repository.exchange']->getById($parameters['id']);
        $content = json_encode($exchange->toArray());
        $statutCode = 200;

        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }

    public function addAction(Request $request, Application $app)
    {
        $parameters = json_decode(file_get_contents('php://input'), true);
        $association = $app['repository.exchange']->insert($parameters);
        
        $statutCode = 200;
        $content = json_encode(array('message' => 'exchange created'));
        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.exchange']->delete($parameters['id']);

        $statutCode = 200;
        $content = json_encode(array('message' => 'exchange deleted'));
        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
    }

    public function sendGift(Request $request, Application $app)
    {
        $parameters = json_decode(file_get_contents('php://input'), true);

        //Check si l'utilisateur a le pokemon

        $user = $app['repository.user']->getById($parameters['user_id']);
        $currentUser = $app['repository.user']->getById($parameters['current_user']);
        $pokemon = $app['repository.pokemon']->getById($parameters['pokemon_id']);

        $pokemons = $app['repository.user']->getPokemons($parameters['current_user']);

         if(!$currentUser) {
            $statutCode = 400;
            $content = json_encode(array('status_code' => '1', 'message' => 'current user doesn\'t exist'));
            return new Response($content, $statutCode, ['Content-type' => 'application/json']);
        }

        if(!$user) {
            $statutCode = 400;
            $content = json_encode(array('status_code' => '2', 'message' => 'user doesn\'t exist'));
            return new Response($content, $statutCode, ['Content-type' => 'application/json']);
        }

        if(!$pokemon) {
            $statutCode = 400;
            $content = json_encode(array('status_code' => '3', 'message' => 'pokemon doesn\'t exist'));
            return new Response($content, $statutCode, ['Content-type' => 'application/json']);
        }

        foreach ($pokemons as $pokemon) {

            if($pokemon["pokemon_id"] == $parameters['pokemon_id']) {
                $association = $app['repository.user']->insertPokemon($parameters['user_id'], $parameters['pokemon_id']);
                $association = $app['repository.user']->removePokemon($parameters['current_user'], $parameters['pokemon_id']);

                $statutCode = 200;
                $content = json_encode(array('message' => 'Gift sent !'));
                return new Response($content, $statutCode, ['Content-type' => 'application/json']);
            }
        }

        $statutCode = 400;
        $content = json_encode(array('status_code' => '4', 'message' => 'current user doesn\'t have this pokemon'));
        return new Response($content, $statutCode, ['Content-type' => 'application/json']);
       

    }
}





