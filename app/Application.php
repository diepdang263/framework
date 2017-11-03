<?php

/*
 * Cache
 */
new \App\Core\Cache(require_once CONFIG . 'cache.php');


/*
 * Route
 */
return new \App\Core\Route();
