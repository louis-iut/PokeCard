<?php

$app->get('/users', 'App\Controller\UserController::getUsers');

$app->get('/pokemons', 'App\Controller\PokemonController::getPokemons')->bind('pokemon.all');
$app->get('/{code}/pokemon/{id}', 'App\Controller\PokemonController::getPokemonWithID')->bind('pokemon.informations');
$app->get('/pokemonsID', 'App\Controller\PokemonController::getPokemonsID');

$app->get('/exchanges', 'App\Controller\ExchangeController::getExchanges');