<?php
/**
 * route_name => [path, controller, function, methods]
 */

return [
    'main_page' => [
        'path' => '/',
        'controller' => 'main_page.php',
        'function' => 'blog\\src\\index',
        'methods' => ['GET']
    ]
];