<?php
namespace blog\src;

echo 'Hello from file' . __FILE__;

function index($app) {
    print_r($app);
}