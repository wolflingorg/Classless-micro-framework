<?php

namespace blog\src\err404;

use function blog\core\renderView;

function index()
{
    return renderView(['404.php']);
}
