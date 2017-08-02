<?php
namespace blog\src\books;

use blog\core;
use blog\exceptions\HttpNotFoundException;

$app['books'] = [
    [
        'name' => 'Learning php, mysql & JavaScript',
        'author' => 'Robin Nixon',
        'price' => 30,
        'tags' => ['php', 'javascript', 'mysql']
    ],
    [
        'name' => 'Php for the Web: Visual QuickStart Guide',
        'author' => 'Larry Ullman',
        'price' => 25,
        'tags' => ['php']
    ],
    [
        'name' => 'pHp and MySqL for Dynamic Web Sites',
        'author' => 'Larry Ullman',
        'price' => 14.39,
        'tags' => ['php', 'mysql']
    ],
    [
        'name' => 'Modern PhP: New Features and Good Practices',
        'author' => 'Josh Lockhart',
        'price' => 24,
        'tags' => ['php']
    ],
    [
        'name' => 'JavaScript and JQuery: Interactive Front-End Web Development',
        'author' => 'Jon Duckett',
        'price' => 20,
        'tags' => ['javascript', 'jquery']
    ],
    [
        'name' => 'Miss Peregrine\'s Home for Peculiar Children',
        'author' => 'Ransom Riggs',
        'price' => 8.18
    ]
];

function index() {
    global $app;

    return core\renderView(['default_layout.php', 'books/index.php'], [
        'books' => $app['books']
    ]);
}

function bookById($id) {
    global $app;

    if (!isset($app['books'][$id])) {
        throw new HttpNotFoundException();
    }

    return core\renderView(['default_layout.php', 'books/book_by_id.php'], [
        'book' => $app['books'][$id]
    ]);
}
