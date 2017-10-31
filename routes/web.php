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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/ping', function () use ($router) {
    return ucfirst($_ENV['APP_NAME']) . ". Built on " . $_ENV['APP_NAME'] . " " . $router->app->version();
});
$router->post('/auth', function () use ($router) {
    return ucfirst($_ENV['APP_NAME']) . ". Built on " . $_ENV['APP_NAME'] . " " . $router->app->version();
});
$router->post('/api/v1/register', function () use ($router) {
    return ucfirst($_ENV['APP_NAME']) . ". Built on " . $_ENV['APP_NAME'] . " " . $router->app->version();
});
