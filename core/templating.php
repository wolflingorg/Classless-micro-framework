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
function renderView($includes, $data = null)
{
    global $app;

    if (empty($app['kernel.view_dir'])) {
        throw new \InvalidArgumentException('Invalid kernel.view_dir');
    }

    $content = null;

    if (is_array($data)) {
        extract($data);
    }

    if (is_array($includes)) {
        $includes = array_reverse($includes);

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
    } else {
        ob_start();

        include_once $includes;

        $content = ob_get_contents();

        ob_end_clean();
    }

    return $content;
}
