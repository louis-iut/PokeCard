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

    public function signup(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $user = $app['repository.user']->inssert($parameters['facebook_id'], $parameters['pseudo']);
        $content = json_encode($user->toArray());
        $statusCode = 200;

        return new Response($content, $statusCode, ['Content-type' => 'application/json']);
    }

}