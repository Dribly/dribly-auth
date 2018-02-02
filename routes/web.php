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
//use App\Http\Controllers\Auth;

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/ping', function () use ($router) {
    return ucfirst($_ENV['APP_NAME']) . ". Built on " . $_ENV['APP_NAME'] . " " . $router->app->version();
});
$router->post('/auth', function () use ($router) {
    return ucfirst($_ENV['APP_NAME']) . ". Built on " . $_ENV['APP_NAME'] . " " . $router->app->version();
});


$router->post('/api/v1/users/register', 'Auth\\RegisterController@register');
$router->get('/api/v1/users/exists', 'UsersController@emailIsValid');
$router->post('/api/v1/users/auth', 'AuthController@auth');
$router->get('/api/v1/users/{id}', 'UsersController@byId');
$router->get('/api/v1/users', 'UsersController@index');
