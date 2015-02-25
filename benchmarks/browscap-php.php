<?php

ini_set('memory_limit', -1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';

$cacheDir = $config['cacheDir'];
$resultsFile = $cacheDir . '/output-browscap-php.txt';
$agentListFile = $config['userAgentListFile'];

$agents = file($agentListFile);

$bench = new Ubench;
$bench->start();

$results = '';

foreach ($agents as $agentString) {
    $browscap = new phpbrowscap\Browscap($cacheDir);
    $browscap->doAutoUpdate = false;
    $r = $browscap->getBrowser($agentString);
    $results .= json_encode(array($r->Platform, $r->Browser, $r->Version)) . "\n";
}

$bench->end();

file_put_contents($resultsFile, $results);

echo $bench->getTime(true), ' secs ', PHP_EOL;
echo $bench->getMemoryPeak(true), ' bytes', PHP_EOL;
