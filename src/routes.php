<?php

$app->get('/users', 'App\Controller\UserController::getUsers');
$app->post('/sign/up', 'App\Controller\UserController::signUp');
$app->post('/sign/in', 'App\Controller\UserController::signIn');

$app->get('/user/{userID}/addPokemon/{pokemonID}', 'App\Controller\UserController::addPokemonAction');
$app->get('/user/{userID}/pokemons', 'App\Controller\UserController::getPokemons');

$app->get('/pokemons', 'App\Controller\PokemonController::getPokemons');
$app->get('/{code}/pokemon/{id}', 'App\Controller\PokemonController::getPokemonWithID');
$app->get('/pokemonsID', 'App\Controller\PokemonController::getPokemonsID');

$app->get('/exchanges', 'App\Controller\ExchangeController::getExchanges');
$app->post('/exchange/{id}/validate', 'App\Controller\ExchangeController::validateExchangeWithID');
$app->get('/exchange/{id}', 'App\Controller\ExchangeController::getExchangeWithID');
$app->post('/exchange/new', 'App\Controller\ExchangeController::addAction');
$app->delete('/exchange/delete/{id}', 'App\Controller\ExchangeController::deleteAction');

$app->get('/ping', 'App\Controller\PokemonController::ping');

$app->post('/gift', 'App\Controller\ExchangeController::sendGift');