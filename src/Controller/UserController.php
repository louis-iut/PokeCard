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


class UserController
{
    public function getUsers($app)
    {
        return new JsonResponse($app['repository.user']->getAll());
    }

}