<?php
// Configuring
$app = [
    'kernel.root_dir' => dirname(dirname(__FILE__)),
    'kernel.view_dir' => dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views'
];
$app['config'] = require '../app/config.php';
$app['routes'] = require '../app/routes.php';

// DB
$app['db'] = function ($app) {
    try {
        $DBH = new PDO(
            "mysql:host={$app['config']['db']['host']};dbname={$app['config']['db']['dbname']}",
            $app['config']['db']['username'],
            $app['config']['db']['passwd']
        );
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        header("500 Internal Server Error", true, 500);
        exit($e->getMessage());
    }

    return $DBH;
};
