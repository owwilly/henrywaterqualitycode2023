<?php
use Steampixel\Route;
/**
 * validate main links
 */
Route::add('/', function () {
    include 'views/index.php';
});

/**
 * validate main links
 */
Route::add('/bubble', function () {
    include 'views/bubble.php';
});

/**
 * validate main links
 */
Route::add('/bar', function () {
    include 'views/bar.php';
});

/**
 * validate main links
 */
Route::add('/scatter', function () {
    include 'views/scatter.php';
});

/**
 * validate main links
 */
Route::add('/radar', function () {
    include 'views/radar.php';
});

/**
 * validate main links
 */
Route::add('/map', function () {
    include 'views/map.php';
});

/**
 * validate main links
 */
Route::add('/parkedcircle', function () {
    include 'views/main.php';
});

