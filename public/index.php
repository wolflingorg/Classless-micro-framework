<?php
include '../app/app.php';
include '../core/routing.php';
include '../core/templating.php';
include '../core/controllers.php';
include '../exceptions/HttpNotFoundException.php';

use blog\core;
use blog\exceptions\HttpNotFoundException;

global $app;

try {
    // Trying to detect current route
    $app['route'] = core\getCurrentRoute($app['routes']);

    // Trying to include needed controller and function
    echo core\renderController($app['route']['controller'], $app['route']['function']);
} catch (HttpNotFoundException $e) {
    echo core\renderController('err404.php', 'blog\\src\\err404\\index');
    exit();
}
