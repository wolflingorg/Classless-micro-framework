<?php
namespace blog\core;

use blog\exceptions\RuntimeException;

function renderController($controller, $function = null, $params = []) {
    global $app;

    // Trying to include needed controller
    $path = $app['kernel.src_dir'] . DIRECTORY_SEPARATOR . $controller;

    if (!is_file($path) || empty($function)) {
        throw new RuntimeException(sprintf("Couldn't find controller %s", $path));
    }

    require $path;

    // Trying to call needed function
    if (!function_exists($function)) {
        throw new RuntimeException(sprintf("Couldn't find function %s", $function));
    }

    return call_user_func($function, ...$params);
}
