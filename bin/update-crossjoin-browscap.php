<?php

ini_set('memory_limit', -1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';

$bench = new Ubench;
$bench->start();

$cacheDir = $config['cacheDir'];
\Crossjoin\Browscap\Cache\File::setCacheDirectory($cacheDir);
$browscap = new \Crossjoin\Browscap\Browscap();
$settings = $browscap->getBrowser()->getData();

$bench->end();
echo ' ', $bench->getTime(true), ' secs ', PHP_EOL;
echo ' ', number_format($bench->getMemoryPeak(true)), ' bytes', PHP_EOL;
