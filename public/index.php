<?php
include '../app/app.php';
include '../core/routing.php';
include '../core/templating.php';
include '../core/controllers.php';

use blog\core;

global $app;

// Trying to detect current route
if (!($route = core\getCurrentRoute($app['routes']))) {
    core\renderView('404.php');
    exit();
}
$app['route'] = $route;

// Trying to include needed controller and function
echo core\renderController($app['route']['controller'], $app['route']['function']);
