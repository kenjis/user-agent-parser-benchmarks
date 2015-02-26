<?php

ini_set('memory_limit', -1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';

use phpbrowscap\Browscap;

$bench = new Ubench;
$bench->start();

$cacheDir = $config['cacheDir'];
$browscap = new Browscap($cacheDir);
$browscap->updateCache();

$bench->end();
echo ' ', $bench->getTime(true), ' secs ', PHP_EOL;
echo ' ', number_format($bench->getMemoryPeak(true)), ' bytes', PHP_EOL;
