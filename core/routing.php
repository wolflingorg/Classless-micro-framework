<?php

namespace app\core;

use app\exceptions\HttpNotFoundException;

/**
 * Returns current route name and file
 *
 * @return array
 * @throws HttpNotFoundException
 */
function getCurrentRoute() {
    global $app;

    if (!isset($app['routes'])) {
        throw new \InvalidArgumentException('Can\'t find routes');
    }

    $path = getCurrentUrl();
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    foreach ($app['routes'] as $name => $route) {
        if (empty($route['file']) || empty($route['function'])) {
            continue;
        }

        $routePattern = buildRoutePattern($route);
        $routeMethods = $route['methods'] ?? ['GET'];

        if (preg_match($routePattern, $path, $matches) && in_array($method, $routeMethods)) {
            return [
                'name' => $name,
                'file' => $route['file'],
                'function' => $route['function'],
                'params' => !empty($matches) ? array_slice($matches, 1) : [],
            ];
        }
    }

    throw new HttpNotFoundException();
}

/**
 * Returns current URL
 *
 *@return string
 */
function getCurrentUrl() {
    if (isset($_SERVER['PATH_INFO'])) {
        return (string)$_SERVER['PATH_INFO'];
    } elseif ($_SERVER['REQUEST_URI']) {
        return str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
    }

    return '/';
}

/**
 * Builds pattern for routing
 *
 * @param $route
 *
 * @return mixed
 */
function buildRoutePattern($route) {
    $routeRequirements = isset($route['requirements']) ? (array)$route['requirements'] : [];
    $routePattern = isset($route['path']) ? '#^' . $route['path'] . '$#' : '#/#';

    return preg_replace_callback(
        '/{([^}]+)}/',
        function ($matches) use ($routeRequirements) {
            return isset($routeRequirements[$matches[1]]) ? '(' . $routeRequirements[$matches[1]] . ')' : '([^/]*)';
        },
        $routePattern
    );
}

/**
 * Returns url by route name
 *
 * @param $name
 * @param array $params
 *
 * @return string
 * @throws \InvalidArgumentException
 */
function createUrl($name, array $params = [])
{
    global $app;

    if (!isset($app['routes'][$name])) {
        throw new \InvalidArgumentException(sprintf("Can't find route %s", $name));
    }

    $path = preg_replace_callback(
        '/{([^}]+)}/',
        function ($matches) use ($params) {
            if (!isset($params[$matches[1]])) {
                throw new \InvalidArgumentException(sprintf("Parameter %s is required", $matches[1]));
            }

            return $params[$matches[1]];
        },
        $app['routes'][$name]['path']
    );

    $routePattern = buildRoutePattern($app['routes'][$name]);
    if(!preg_match($routePattern, $path)) {
        throw new \InvalidArgumentException("Invalid parameters. Please, check the requirements section");
    }

    return $path;
}

/**
 * Redirects to route
 *
 * @param $name
 * @param array $params
 * @param int $status
 */
function redirect($name, array $params = [], $status = 302)
{
    $url = createUrl($name, $params);

    header(sprintf('Location: %s', $url, $status));
    exit;
}
