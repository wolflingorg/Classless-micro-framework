<?php
session_start();

initUserData();

/**
 * Sets user data
 *
 * @param $key
 * @param $data
 */
function setUserData($key, $data) {
    $_SESSION['user_data'][$key] = $data;
}

/**
 * Get user data by key
 *
 * @param $key
 *
 * @return array|null
 */
function getUserData($key) {
    return isset($_SESSION['user_data'][$key]) ? $_SESSION['user_data'][$key] : [];
}

/**
 * Initialises user data
 */
function initUserData() {
    if (!array_key_exists('user_data', $_SESSION)) {
        $_SESSION['user_data'] = [];
    }
}

/**
 * Erases user data
 *
 * @param null $key
 */
function clearUserDara($key = null) {
    if (!$key) {
        unset($_SESSION['user_data']);
        initUserData();
    } else {
        unset($_SESSION['user_data'][$key]);
    }
}
