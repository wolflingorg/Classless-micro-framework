<?php
namespace app\core;

/**
 * Add flash message to an user session
 *
 * @param $name
 * @param $message
 */
function addFlash($name, $message) {
    static $messages = [];

    $messages[$name][] = $message;

    setUserData('flash', $messages);
}

/**
 * Returns flash messages by key
 *
 * @param $key
 *
 * @return array
 */
function getFlashes($key) {
    $messages = getUserData('flash');

    if (!array_key_exists($key, $messages)) {
        return [];
    }

    $message = $messages[$key];

    unset($messages[$key]);

    setUserData('flash', $messages);

    return $message;
}
