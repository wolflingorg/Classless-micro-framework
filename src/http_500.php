<?php

namespace blog\src\http_500;

use blog\core;

function index($message = '')
{
    return core\renderView(['http_500.php'], [
        'message' => $message
    ]);
}
