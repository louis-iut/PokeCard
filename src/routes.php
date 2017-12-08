<?php

$app->get('/users', 'App\Controller\IndexController::getUsers');

$app->get('/{code}/pokemons', 'App\Controller\PokemonController::getPokemons')->bind('pokemon.list');
$app->get('/pokemons', 'App\Controller\PokemonController::getPokemonsWithoutCode')->bind('pokemon.all');
$app->get('/{code}/pokemon/{id}', 'App\Controller\PokemonController::getPokemonWithID')->bind('pokemon.informations');
$app->get('/pokemonsID', 'App\Controller\PokemonController::getPokemonsID');