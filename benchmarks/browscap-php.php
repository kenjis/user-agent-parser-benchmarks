<?php

ini_set('memory_limit', -1);

require __DIR__ . '/../vendor/autoload.php';

$resultsFile = __DIR__ . '/output-browscap-php.txt';
$agentListFile = __DIR__ . '/../data/ua-list.txt';
$cacheDir = __DIR__ . '/../cache';

$agents = file($agentListFile);

$bench = new Ubench;
$bench->start();

$browscap = new phpbrowscap\Browscap($cacheDir);
$browscap->doAutoUpdate = false;
$results = '';

foreach ($agents as $agentString) {
    $r = $browscap->getBrowser($agentString);
    $results .= sprintf('"%s","%s","%s"' . "\n", $r->Platform, $r->Browser, $r->Version);
}

$bench->end();

file_put_contents($resultsFile, $results);

echo $bench->getTime(true), ' secs ', PHP_EOL;
echo $bench->getMemoryPeak(true), ' bytes', PHP_EOL;
