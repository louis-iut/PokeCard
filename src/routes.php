<?php

$app->get('/pokemons', 'App\Controller\PokemonController::getPokemons')->bind('pokemon.all');
$app->get('/{code}/pokemon/{id}', 'App\Controller\PokemonController::getPokemonWithID')->bind('pokemon.informations');
$app->get('/pokemonsID', 'App\Controller\PokemonController::getPokemonsID');

$app->get('/exchanges', 'App\Controller\ExchangeController::getExchanges');
$app->get('/exchange/{id}', 'App\Controller\ExchangeController::getExchangeWithID');
$app->post('/exchange/new', 'App\Controller\ExchangeController::addAction')->bind('exchange.new');
$app->get('/exchange/delete/{id}', 'App\Controller\ExchangeController::deleteAction')->bind('exchange.delete');


$app->get('/users', 'App\Controller\UserController::getUsers');
$app->post('/login', 'App\Controller\UserController::login');

$app->get('/user/{userID}/addPokemon/{pokemonID}', 'App\Controller\UserController::addPokemonAction');
$app->get('/user/{userID}/pokemons', 'App\Controller\UserController::getPokemons');