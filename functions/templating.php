<?php

namespace blog\functions;

/**
 * Includes all files
 *
 * @param $includes
 * @param null $data
 */
function renderView($includes, $data = null)
{
    global $app;

    if (empty($app['kernel.view_dir'])) {
        throw new \InvalidArgumentException('Invalid kernel.view_dir');
    }

    $content = null;
    $html = null;

    if (is_array($data)) {
        extract($data);
    }

    if (is_array($includes)) {
        $includes = array_reverse($includes);
        $page = array_pop($includes);

        foreach ($includes as $include) {
            ob_start();
            include_once $app['kernel.view_dir'] . DIRECTORY_SEPARATOR . $include;
            $content = ob_get_contents();
            ob_end_clean();
        }

        ob_start();
        include $app['kernel.view_dir'] . DIRECTORY_SEPARATOR . $page;
        $html = ob_get_contents();
        ob_end_clean();

        echo $html;
    } else {
        include $includes;
    }
}
