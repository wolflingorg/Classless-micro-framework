<?php
include '../app/app.php';
include '../core/routing.php';
include '../core/templating.php';
include '../core/controllers.php';
include '../exceptions/HttpNotFoundException.php';
include '../exceptions/RuntimeException.php';

use app\core;
use app\exceptions\HttpNotFoundException;

global $app;

try {
    // Trying to detect current route
    $app['route'] = core\getCurrentRoute();

    // Trying to include needed controller and function
    echo core\renderController($app['route']['controller'], $app['route']['function'], $app['route']['params']);
} catch (HttpNotFoundException $e) {
    echo core\renderController('error.php', 'app\\src\\error\\httpNotFoundError', [$e->getMessage()]);
    exit();
} catch (\Exception $e) {
    echo core\renderController('error.php', 'app\\src\\error\\internalServerError', [$e->getMessage()]);
    exit();
}
