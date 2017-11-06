<?php

/*
 * Cache
 */
new \App\Core\Cache(require_once CONFIG . 'cache.php');

/**
 * Logging
 */
\App\Core\Log::$config = array_change_key_case(\App\Core\Config::read('App.Log'), CASE_LOWER);

/*
 * Error Reporting
 */
error_reporting(-1);
set_error_handler([
    'App\Core\Error',
    'collect'
]);

/*
 * App
 */
date_default_timezone_set(\App\Core\Config::read('App.Timezone'));

/*
 * Route
 */
return new \App\Core\Route();
