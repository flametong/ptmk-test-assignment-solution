<?php

require_once dirname(__DIR__) . '/config/init.php';
require_once ROOT . '/vendor/autoload.php';

use App\App;

(new App($argv))->run();