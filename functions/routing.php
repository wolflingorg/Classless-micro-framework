<?php

namespace blog\functions;

/**
 * Returns current route name and controller
 *
 * @param array $routes
 *
 * @return array
 */
function getCurrentRoute(array $routes = [])
{
    $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
    $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

    foreach ($routes as $name => $route) {
        if (empty($route['controller'])) {
            continue;
        }

        $routePattern = isset($route['path']) ? '#^' . addslashes($route['path']) . '$#' : '#\/#';
        $routeMethods = isset($route['methods']) ? $route['methods'] : ['GET'];

        if (preg_match($routePattern, $path) && in_array($method, $routeMethods)) {
            return [
                'name' => $name,
                'controller' => $route['controller'],
                'function' => isset($route['function']) ? $route['function'] : null
            ];
        }
    }

    return [];
}
