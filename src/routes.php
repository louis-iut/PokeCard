<?php

$app->get('/users', 'App\Controller\IndexController::getUsers');
$app->get('/pokemons', 'App\Controller\PokemonController::getPokemons');
$app->get('/pokemon/{id}', 'App\Controller\PokemonController::getPokemonWithID')->bind('pokemon.informations');;
$app->get('/pokemonsID', 'App\Controller\PokemonController::getPokemonsID');