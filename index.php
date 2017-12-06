<?php

// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

require_once APP . '/config/config.php';

require_once APP . '/lib/session.php';

require_once APP . '/core/application.php';
require_once APP . '/core/controller.php';

$app = new Application();
