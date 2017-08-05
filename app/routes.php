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
    'books_pagination' => [
        'path' => '/books-{page}',
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
    'security_login' => [
        'path' => '/login',
        'file' => 'security.php',
        'function' => 'app\\src\\security\\login',
        'methods' => ['POST']
    ],
    'security_logout' => [
        'path' => '/login',
        'file' => 'security.php',
        'function' => 'app\\src\\security\\logout',
        'methods' => ['POST']
    ],
];
