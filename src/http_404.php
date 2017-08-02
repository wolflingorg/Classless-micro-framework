<?php

namespace blog\src\http_404;

use blog\core;

function index($message = '')
{
    return core\renderView(['http_404.php'], [
        'message' => $message
    ]);
}
