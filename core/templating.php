<?php

namespace blog\core;

/**
 * Includes all files
 *
 * @param $includes
 * @param null $data
 *
 * @return null|string
 */
function renderView(array $includes, $data = null)
{
    global $app;

    if (empty($app['kernel.view_dir'])) {
        throw new \InvalidArgumentException('Invalid kernel.view_dir');
    }

    $content = null;

    $includes = array_reverse($includes);

    if (is_array($data)) {
        extract($data);
    }

    foreach ($includes as $include) {
        if (!ob_get_level()) {
            ob_start();
        }

        include_once $app['kernel.view_dir'] . DIRECTORY_SEPARATOR . $include;

        $content = ob_get_contents();

        if (ob_get_level()) {
            ob_end_clean();
        }
    }

    return $content;
}
