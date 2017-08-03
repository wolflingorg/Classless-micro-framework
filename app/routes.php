<?php
/**
 * route_name => [path, file, function, methods]
 */

return [
    'main_page' => [
        'path' => '/',
        'file' => 'main.php',
        'function' => 'app\\src\\main\\index',
        'methods' => ['GET']
    ],
    'books' => [
        'path' => '/books',
        'file' => 'books.php',
        'function' => 'app\\src\\books\\index',
        'methods' => ['GET']
    ],
    'book_by_id' => [
        'path' => '/books/{id}',
        'requirements' => [
            'id' => '\d+'
        ],
        'file' => 'books.php',
        'function' => 'app\\src\\books\\bookById',
        'methods' => ['GET']
    ],
];
