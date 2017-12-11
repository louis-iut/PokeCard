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

    public function login(Request $request, Application $app) {

        $parameters = json_decode(file_get_contents('php://input'), true);
        var_dump($parameters);
        die();
        $user = $app['repository.user']->getByEmail($parameters['email']);
        die();
    }

}
