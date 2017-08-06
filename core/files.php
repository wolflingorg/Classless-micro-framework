<?php
namespace app\core;

use app\exceptions\RuntimeException;

/**
 * Includes file and runs function with parameters
 *
 * @param $file
 * @param null $function
 * @param array $params
 *
 * @return mixed
 * @throws RuntimeException
 */
function renderFile($file, $function = null, $params = []) {
    global $app;

    // Trying to include needed file
    $path = $app['kernel.src_dir'] . DIRECTORY_SEPARATOR . $file;

    if (!is_file($path) || empty($function)) {
        throw new RuntimeException(sprintf("Couldn't find file %s", $path));
    }

    require_once $path;

    // Trying to call needed function
    if (!function_exists($function)) {
        throw new RuntimeException(sprintf("Couldn't find function %s", $function));
    }

    return call_user_func($function, ...$params);
}
