<?php
namespace app\core;

/**
 * Stores user to session
 *
 * @param $user
 */
function persistUser($user) {
    $_SESSION['user'] = $user;
    $_SESSION['user_verification_data'] = [
        'ip' => getUserIp(),
        'user-agent' => getUserAgent(),
    ];
}

/**
 * Restores user from session + validation
 *
 * @return null|array
 */
function restoreUser() {
    if (!isset($_SESSION['user']) || !isset($_SESSION['user_verification_data'])) {
        return null;
    }

    $user = $_SESSION['user'];
    $verificationData = $_SESSION['user_verification_data'];

    if ($verificationData['ip'] != getUserIp() || $verificationData['user-agent'] != getUserAgent()) {
        return null;
    }

    return $user;
}

/**
 * Deletes user information from the session
 */
function clearUser() {
    unset($_SESSION['user']);
    unset($_SESSION['user_verification_data']);
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
