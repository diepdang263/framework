<?php

/*
 * Error Reporting
 */
error_reporting(-1);
set_error_handler([
    'App\Core\Error',
    'collect'
]);

/*
 * Cache
 */
new \App\Core\Cache(require_once CONFIG . 'cache.php');

/*
 * App
 */
date_default_timezone_set(\App\Core\Config::read('App.Timezone'));

/*
 * Route
 */
return new \App\Core\Route();
