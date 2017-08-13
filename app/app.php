<?php
namespace app\core;

// Includes
include '../core/sessions.php';
include '../core/security.php';
include '../core/routing.php';
include '../core/templating.php';
include '../core/files.php';
include '../core/flash_messages.php';
include '../exceptions/HttpNotFoundException.php';
include '../exceptions/RuntimeException.php';

// Configuring
$app = [
    'kernel.root_dir' => dirname(dirname(__FILE__))
];
$app = array_merge($app, [
    'kernel.view_dir' => $app['kernel.root_dir'] . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views',
    'kernel.src_dir' => $app['kernel.root_dir'] . DIRECTORY_SEPARATOR . 'src',
    'kernel.app_dir' => $app['kernel.root_dir'] . DIRECTORY_SEPARATOR . 'app',
    'kernel.services_dir' => $app['kernel.root_dir'] . DIRECTORY_SEPARATOR . 'services'
]);

$app['config']  = require $app['kernel.app_dir'] . DIRECTORY_SEPARATOR . 'config.php';
$app['routes']  = require $app['kernel.app_dir'] . DIRECTORY_SEPARATOR . 'routes.php';
$app['user']    = require $app['kernel.app_dir'] . DIRECTORY_SEPARATOR . 'user.php';
