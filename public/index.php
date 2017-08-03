<?php
include '../app/app.php';
include '../core/routing.php';
include '../core/templating.php';
include '../core/files.php';
include '../exceptions/HttpNotFoundException.php';
include '../exceptions/RuntimeException.php';

use app\core;
use app\exceptions\HttpNotFoundException;

global $app;

try {
    // Trying to detect current route
    $app['route'] = core\getCurrentRoute();

    // Trying to include needed file and function
    echo core\renderFile($app['route']['file'], $app['route']['function'], $app['route']['params']);
} catch (HttpNotFoundException $e) {
    echo core\renderFile('error.php', 'app\\src\\error\\httpNotFoundError', [$e->getMessage()]);
    exit();
} catch (\Exception $e) {
    echo core\renderFile('error.php', 'app\\src\\error\\internalServerError', [$e->getMessage()]);
    exit();
}
