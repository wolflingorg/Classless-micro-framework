<?php

namespace app\core;

/**
 * Global variable contains all view data
 */
$view_data = [];

/**
 * Includes all files
 *
 * @param $includes
 * @param array $data
 *
 * @return null|string
 */
function renderView(array $includes, array $data = []) {
    global $app, $view_data;

    if (empty($app['kernel.view_dir'])) {
        throw new \InvalidArgumentException('Invalid kernel.view_dir');
    }

    $content = null;

    $includes = array_reverse($includes);

    $view_data = array_replace_recursive($view_data, $data);

    extract($view_data);

    foreach ($includes as $include) {
        ob_start();

        include $app['kernel.view_dir'] . DIRECTORY_SEPARATOR . $include;
        $content = ob_get_contents();

        ob_end_clean();
    }

    return $content;
}
