<?php

$app->get('/pokemons', 'App\Controller\PokemonController::getPokemons')->bind('pokemon.all');
$app->get('/{code}/pokemon/{id}', 'App\Controller\PokemonController::getPokemonWithID')->bind('pokemon.informations');
$app->get('/pokemonsID', 'App\Controller\PokemonController::getPokemonsID');

$app->get('/users', 'App\Controller\UserController::getUsers');
$app->post('/login', 'App\Controller\UserController::login');
