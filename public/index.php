<?php

define('APP_MODE', 'DEVERLOPE');

// Include core file
require_once dirname(__DIR__) . '/config/paths.php';

require_once ROOT . 'vendor' . DS . 'autoload.php';

$app = require_once APP . 'Application.php';

// Run the application
$app->start(CONFIG);
