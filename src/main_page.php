<?php

namespace blog\src;

use function blog\functions\renderView;

function index($app)
{
    renderView(['main_layout.php', 'books.php'], [
        'message' => 'Hello'
    ]);
}
