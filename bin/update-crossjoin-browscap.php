<?php

ini_set('memory_limit', -1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';

$cacheDir = $config['cacheDir'];
\Crossjoin\Browscap\Cache\File::setCacheDirectory($cacheDir);
$browscap = new \Crossjoin\Browscap\Browscap();
$settings = $browscap->getBrowser()->getData();
