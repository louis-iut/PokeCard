<?php

$app->get('/users', 'App\Users\Controller\IndexController::getUsers')->bind('users.users');
$app->get('/pokemons', 'App\Pokemons\Controller\IndexController::getPokemons')->bind('pokemons.pokemons');
/*$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');
$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');*/