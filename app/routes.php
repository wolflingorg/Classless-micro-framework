<?php
/**
 * route_name => [path, controller, function, methods]
 */

return [
    'main_page' => [
        'path' => '/',
        'controller' => 'main.php',
        'function' => 'blog\\src\\main\\index',
        'methods' => ['GET']
    ],
    'books' => [
        'path' => '/books',
        'controller' => 'books.php',
        'function' => 'blog\\src\\books\\index',
        'methods' => ['GET']
    ],
    'book_by_id' => [
        'path' => '/books/{id}',
        'controller' => 'books.php',
        'function' => 'blog\\src\\books\\bookById',
        'methods' => ['GET']
    ],
];
