<?php

$app->get('/users', 'App\Users\Controller\IndexController::getUsers');
$app->get('/pokemons', 'App\Controller\PokemonController::getPokemons');