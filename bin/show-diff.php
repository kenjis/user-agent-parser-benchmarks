<?php

require __DIR__ . '/../config.php';

$dataDir = __DIR__ . '/../data';
$cacheDir = __DIR__ . '/../cache';

$userAgentStringsFile = $dataDir . '/ua-list-all.txt';
$userAgentStrings = file($userAgentStringsFile);
$countUserAgent = count($userAgentStrings);

$parsers = $config['parsers'];

foreach ($parsers as $parser) {
    $file = $cacheDir . '/normalized-output-' . $parser . '.txt';
    $normalized[$parser] = file($file);
    $count = count($normalized[$parser]);
    if ($countUserAgent !== $count) {
        echo 'all: ' . $countAll . ' <> ' .$parser . ': ' . $count . PHP_EOL;
        exit(1);
    }
}

$countParser = count($parsers);
for ($i = 0; $i < $countUserAgent; $i++) {
    $diff = false;
    for ($j = 0; $j < $countParser - 1; $j++) {
        if ($normalized[$parsers[$j]][$i] !== $normalized[$parsers[$j + 1]][$i]) {
            $diff = true;
        }
    }

    if ($diff === true) {
        echo $userAgentStrings[$i];
        for ($j = 0; $j < $countParser; $j++) {
            printf("  %19s: %s", $parsers[$j], $normalized[$parsers[$j]][$i]);
        }
        echo PHP_EOL;
    }
}
