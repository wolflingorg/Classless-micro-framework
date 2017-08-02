<?php
namespace blog\core;

function renderController($controller, $function = null, $params = []) {
    global $app;

    // Trying to include needed controller
    $path = $app['kernel.src_dir'] . DIRECTORY_SEPARATOR . $controller;

    if (!is_file($path) || empty($function)) {
        header("500 Internal Server Error", true, 500);

        exit(sprintf("Couldn't find controller %s", $path));
    }

    require $path;

    // Trying to call needed function
    if (!function_exists($function)) {
        header("500 Internal Server Error", true, 500);

        exit(sprintf("Couldn't find function %s", $function));
    }

    return call_user_func($function, ...$params);
}
