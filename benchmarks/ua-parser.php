<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';

$cacheDir = $config['cacheDir'];
$resultsFile = $cacheDir . '/output-ua-parser.txt';
$agentListFile = $config['userAgentListFile'];

$agents = file($agentListFile);

$bench = new Ubench;
$bench->start();

$results = '';

foreach ($agents as $agentString) {
    $parser = UAParser\Parser::create();
    $r = $parser->parse($agentString);
    $results .= json_encode(array($r->os->family, $r->ua->family, $r->ua->toVersion())) . "\n";
}

$bench->end();

file_put_contents($resultsFile, $results);

echo $bench->getTime(true), ' secs ', PHP_EOL;
echo $bench->getMemoryPeak(true), ' bytes', PHP_EOL;
