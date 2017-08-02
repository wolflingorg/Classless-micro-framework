<?php

namespace blog\src\err404;

use blog\core;

function index()
{
    return core\renderView(['404.php']);
}
