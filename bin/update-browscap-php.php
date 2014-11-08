<?php

ini_set('memory_limit', -1);

require __DIR__ . '/../vendor/autoload.php';

$cacheDir = __DIR__ . '/../cache';

use phpbrowscap\Browscap;

$browscap = new Browscap($cacheDir);
$browscap->updateCache();
