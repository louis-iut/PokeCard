<?php

$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/test', 'App\Users\Controller\IndexController::testjson')->bind('users.test');
$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');