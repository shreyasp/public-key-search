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

$app->get('/', 'ShowIndexPageController');
$app->get('/main/{id}', ['middleware' => 'usersession', 'uses' => 'ShowMainPageController']);

// Login and Register - UserController
$app->post('/login', 'UserController@authenticateUser');

// Validate for proper input and create a new user
$app->post('/register', ['middleware' => 'validator', 'uses' => 'UserController@createNewUser']);

// Logout user
$app->get('/logout', 'UserController@logoutUser');

// GitHub Connect and Redirect OAuth
$app->get('/connect_to_github', 'GithubAuthController@connect');
$app->get('/redirect_oauth', 'GithubAuthController@redirect_oauth');
