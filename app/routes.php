<?php
/**
 * route_name => [path, controller, function, methods]
 */

return [
    'main_page' => [
        'path' => '/',
        'controller' => 'main.php',
        'function' => 'app\\src\\main\\index',
        'methods' => ['GET']
    ],
    'books' => [
        'path' => '/books',
        'controller' => 'books.php',
        'function' => 'app\\src\\books\\index',
        'methods' => ['GET']
    ],
    'book_by_id' => [
        'path' => '/books/{id}',
        'requirements' => [
            'id' => '\d+'
        ],
        'controller' => 'books.php',
        'function' => 'app\\src\\books\\bookById',
        'methods' => ['GET']
    ],
];
