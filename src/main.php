<?php

namespace blog\src\main;

use function blog\core\renderView;

function index()
{
    return renderView(['default_layout.php', 'main/index.php']);
}
