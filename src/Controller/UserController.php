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

}