<?php
namespace app\src\security;

use app\core;

$app['users'] = [
    [
        'username' => 'Admin',
        'password' => '$2y$10$vsEMznQh2WaSPMdTUavA2.Xt7HRDmGUZYLmyGlrHg/fHkLQEc79Le' // plain password: Admin
    ]
];

function login() {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        core\redirect('main_page');
    }

    if (!($user = loadUserByUsername($_POST['username']))) {
        core\redirect('main_page');
    }

    if (!password_verify($_POST['password'], $user['password'])) {
        core\redirect('main_page');
    }

    core\persistUser($user);

    core\redirect('main_page');
}

function logout() {
    core\clearUser();
    core\redirect('main_page');
}

function loadUserByUsername($username) {
    global $app;

    return current(array_filter($app['users'], function($user) use($username) {
        return $user['username'] == $username;
    }));
}
