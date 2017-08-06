<?php
namespace app\core;

/**
 * Stores user to session
 *
 * @param $user
 */
function persistUser($user) {
    session_regenerate_id();

    setUserData('user', $user);
    setUserData('security', [
        'ip' => getUserIp(),
        'user-agent' => getUserAgent(),
    ]);
}

/**
 * Restores user from session + validation
 *
 * @return null|array
 */
function restoreUser() {
    if (!($user = getUserData('user')) || !($security = getUserData('security'))) {
        return null;
    }

    if ($security['ip'] != getUserIp() || $security['user-agent'] != getUserAgent()) {
        return null;
    }

    return $user;
}

/**
 * Deletes user information from the session
 */
function clearUser() {
    clearUserDara('user');
    clearUserDara('security');
}

/**
 * Returns real user IP
 *
 * @return string
 */
function getUserIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return (string)$ip;
}

/**
 * Returns user agent
 *
 * @return string
 */
function getUserAgent() {
    return (string)$_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
}
