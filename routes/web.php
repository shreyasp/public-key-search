<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Index Page - Single Action Controller
$app->get('/', 'ShowIndexPageController');

// Main Page - Single Action Controller
$app->get('/main/{id}', 'ShowMainPageController');

// Login and Register - UserController
$app->post('/login', 'UserController@authenticateUser');

$app->get('/logout', 'UserController@logoutUser');

$app->post('/register', 'UserController@createNewUser');
