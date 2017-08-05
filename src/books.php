<?php
namespace app\src\books;

use app\core;
use app\exceptions\HttpNotFoundException;

$app['books'] = [
    [
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51mk+9J-dbL._AC_US218_.jpg',
        'name' => 'Learning php, mysql & JavaScript',
        'author' => 'Robin Nixon',
        'price' => 30,
        'date' => '2017-08-12',
        'tags' => ['php', 'javascript', 'mysql']
    ],
    [
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/41Bgqdnu7kL._AC_US218_.jpg',
        'name' => 'Php for the Web: Visual QuickStart Guide',
        'author' => 'Larry Ullman',
        'price' => 25,
        'date' => '2017-08-11',
        'tags' => ['php']
    ],
    [
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/41kKdIyD06L._AC_US218_.jpg',
        'name' => 'pHp and MySqL for Dynamic Web Sites',
        'author' => 'Larry Ullman',
        'price' => 14.39,
        'date' => '2017-08-05',
        'tags' => ['php', 'mysql']
    ],
    [
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/516kv5hpwuL._AC_US218_.jpg',
        'name' => 'Modern PhP: New Features and Good Practices',
        'author' => 'Josh Lockhart',
        'price' => 24,
        'date' => '2017-08-10',
        'tags' => ['php']
    ],
    [
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/41oa41LdNdL._AC_US218_.jpg',
        'name' => 'JavaScript and JQuery: Interactive Front-End Web Development',
        'author' => 'Jon Duckett',
        'price' => 20,
        'date' => '2017-08-09',
        'tags' => ['javascript', 'jquery']
    ],
    [
        'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51A741xAWAL._AC_US218_.jpg',
        'name' => 'Miss Peregrine\'s Home for Peculiar Children',
        'author' => 'Ransom Riggs',
        'date' => '2017-08-08',
        'price' => 8.18
    ]
];

function index($page = 0) {
    $criteria = [
        'sort' => 'date',
        'length' => 2,
        'offset'
    ];

    return core\renderView(['default_layout.php', 'books/index.php'], [
        'content' => core\renderFile('books.php', 'app\\src\\books\\search', [$criteria]),
    ]);
}

function search($criteria = []) {
    global $app;

    $criteria = array_merge([
        'q' => null,
        'tag' => null,
        'sort' => null,
        'length' => 3,
        'offset' => 0,
        'total' => sizeof($app['books'])
    ], $criteria);

    $books = $app['books'];

    if (!empty($criteria['tag'])) {
        $tag = $criteria['tag'];

        $books = array_filter($books, function ($book) use ($tag) {
            return !empty($book['tags']) && in_array($tag, (array)$book['tags']);
        });
    }
    if (!empty($criteria['q'])) {
        $q = $criteria['q'];

        $books = array_filter($books, function ($book) use ($q) {
            return preg_match('/' . $q . '/', $book['name']);
        });
    }
    if (!empty($criteria['sort'])) {
        $key = trim($criteria['sort'], '-');
        $direction = substr($criteria['sort'], 0, 1) == '-' ? 1 : -1;

        usort($books, function ($a, $b) use ($key, $direction) {
            if (!array_key_exists($key, $a) || !array_key_exists($key, $b)) {
                return 0;
            }

            return $a[$key] == $b[$key] ? 0 : ($a[$key] > $b[$key] ? 1 * $direction : -1 * $direction);
        });
    }

    return core\renderView(['books/books_list.php'], [
        'books' => array_slice($books, $criteria['offset'], $criteria['length']),
        'criteria' => $criteria
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
