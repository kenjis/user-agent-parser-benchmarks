<?php

$url = 'http://localhost:8000';
$output = __DIR__ . '/../cache/benchmark-results.json';

$parsers = array('browscap-php', 'ua-parser', 'woothee');

foreach ($parsers as $parser) {
    echo $parser . PHP_EOL;
    $result = file_get_contents($url . '/benchmarks/' . $parser .'.php');
    $tmp = explode("\n", $result);
    $time = (float) trim($tmp[0], ' sec');
    $memory = (int) trim($tmp[1], ' bytes');

    $data[$parser] = array(
        'time' => $time,
        'memory' => $memory,
    );
}

file_put_contents($output, json_encode($data));
