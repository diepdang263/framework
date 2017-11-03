<?php

define('APP_ENV', 'DEVELOPMENT');
define('BLOG_START', microtime(true));

// Include core file
require_once dirname(__DIR__) . '/config/paths.php';

require_once ROOT . 'vendor' . DS . 'autoload.php';

// Include bootstrap application
$app = require_once ROOT . 'app' . DS . 'Application.php';

// Run the application
$app->start(\App\Core\Config::read('Routes'));

echo PHP_EOL . '<br />Execute time: ' . round((microtime(true) - BLOG_START),4);
