<?php

namespace App\Controller;

use Silex\Application;
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

        $association = $app['repository.user']->insertPokemon($parameters['user_id'], $parameters['pokemon_id']);
        $association = $app['repository.user']->removePokemon($parameters['current_user'], $parameters['pokemon_id']);

        $statutCode = 200;
        $content = json_encode(array('message' => 'Gift sent !'));
        return new Response($content, $statutCode, ['Content-type' => 'application/json']);

    }
}





