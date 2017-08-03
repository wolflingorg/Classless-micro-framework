<?php

namespace app\src\main;

use function app\core\renderView;

function index()
{
    return renderView(['default_layout.php', 'main/index.php']);
}
