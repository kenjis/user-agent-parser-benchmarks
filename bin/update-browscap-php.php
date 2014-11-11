<?php

ini_set('memory_limit', -1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';

$cacheDir = $config['cacheDir'];

use phpbrowscap\Browscap;

$browscap = new Browscap($cacheDir);
$browscap->updateCache();
