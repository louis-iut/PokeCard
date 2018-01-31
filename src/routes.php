<?php

$app->get('/users', 'App\Controller\UserController::getUsers');
$app->post('/signup', 'App\Controller\UserController::signup');
$app->post('/login', 'App\Controller\UserController::login');

$app->get('/user/{userID}/addPokemon/{pokemonID}', 'App\Controller\UserController::addPokemonAction');
$app->get('/user/{userID}/pokemons', 'App\Controller\UserController::getPokemons');

$app->get('/pokemons', 'App\Controller\PokemonController::getPokemons');
$app->get('/{code}/pokemon/{id}', 'App\Controller\PokemonController::getPokemonWithID');
$app->get('/pokemonsID', 'App\Controller\PokemonController::getPokemonsID');

$app->get('/exchanges', 'App\Controller\ExchangeController::getExchanges');
$app->get('/exchange/{id}', 'App\Controller\ExchangeController::getExchangeWithID');
$app->post('/exchange/new', 'App\Controller\ExchangeController::addAction');
$app->delete('/exchange/delete/{id}', 'App\Controller\ExchangeController::deleteAction');
$app->post('/gift', 'App\Controller\ExchangeController::sendGift');