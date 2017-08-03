<?php

namespace blog\core;

use blog\exceptions\HttpNotFoundException;

/**
 * Returns current route name and controller
 *
 * @return array
 * @throws HttpNotFoundException
 */
function getCurrentRoute()
{
    global $app;

    $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
    $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

    foreach ($app['routes'] as $name => $route) {
        if (empty($route['controller'])) {
            continue;
        }

        $routeRequirements = !isset($route['requirements']) || !is_array($route['requirements']) ? [] : $route['requirements'];
        $routeRequirements = array_merge($routeRequirements, ['[^}]+' => '.*?']);
        $routePattern = isset($route['path']) ? '#^' . $route['path'] . '$#' : '#/#';
        $routePattern = preg_replace(
            array_map(function($value) {return '#{' . $value . '}#';}, array_keys($routeRequirements)),
            array_map(function($value) {return '(' . $value . ')';}, array_values($routeRequirements)),
            $routePattern
        );
        $routeMethods = isset($route['methods']) ? $route['methods'] : ['GET'];

        if (preg_match($routePattern, $path, $matches) && in_array($method, $routeMethods)) {
            return [
                'name' => $name,
                'controller' => $route['controller'],
                'function' => isset($route['function']) ? $route['function'] : null,
                'params' => !empty($matches) ? array_slice($matches, 1) : [],
            ];
        }
    }

    throw new HttpNotFoundException();
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
function createUrl($name, $params = [])
{
    global $app;

    if (!isset($app['routes'][$name])) {
        throw new \InvalidArgumentException(sprintf("Can't find route %s", $name));
    }

    return '/trololo.html';
}
