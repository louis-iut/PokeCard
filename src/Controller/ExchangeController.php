<?php

namespace App\Controller;

use Silex\Application;
use App\Entity\Exchange;
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

        return new Response($content, $statutCode ,['Content-type' => 'application/json']); 
    }


    public function getExchangeWithID(Request $request, Application $app)
    {

    	$parameters = $request->attributes->all();
        $exchange = $app['repository.exchange']->getById($parameters['id']);
        $content = json_encode($exchange->toArray());
        $statutCode = 200;

        return new Response($content, $statutCode ,['Content-type' => 'application/json']);
    }
}