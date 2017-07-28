<?php
include '../app/app.php';
include '../functions/routing.php';
include '../functions/templating.php';

use blog\functions;

// Trying to detect current route
if (!($route = functions\getCurrentRoute($app['routes']))) {
    header("HTTP/1.0 404 Not Found", true, 404);
    exit();
}
$app['route'] = $route;

// Trying to include needed controller
$path = '../src/' . $app['route']['controller'];
if (!is_file($path)) {
    header("500 Internal Server Error", true, 500);
    exit();
}
require $path;

// Trying to call needed function
if (!empty($app['route']['function'])) {
    if (!function_exists($app['route']['function'])) {
        header("500 Internal Server Error", true, 500);
        exit();
    }
    call_user_func($app['route']['function'], $app);
}
