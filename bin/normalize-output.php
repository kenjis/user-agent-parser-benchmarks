<?php

require __DIR__ . '/../config.php';

$parsers = $config['parsers'];

function normalize_browscap(array $browser)
{
    // OS
    if ($browser[0] === 'unknown') $browser[0] = '';
    if ($browser[0] === 'Win2000') $browser[0] = 'Windows 2000';
    if ($browser[0] === 'WinXP') $browser[0] = 'Windows XP';
    if ($browser[0] === 'WinVista') $browser[0] = 'Windows Vista';
    if ($browser[0] === 'Win7') $browser[0] = 'Windows 7';
    if ($browser[0] === 'Win8') $browser[0] = 'Windows 8';
    if ($browser[0] === 'Win8.1') $browser[0] = 'Windows 8.1';
    if ($browser[0] === 'MacOSX') $browser[0] = 'Mac OS X';
    // Browser
    if ($browser[1] === 'Default Browser') $browser[1] = '';
    if ($browser[1] === 'IE') $browser[1] = 'Internet Explorer';
    // Version
    if ($browser[2] === '0.0') $browser[2] = '';

    return $browser;
}

function normalize_ua_parser(array $browser)
{
    // OS
    if ($browser[0] === 'Other') $browser[0] = '';
    // Browser
    if ($browser[1] === 'Other') $browser[1] = '';
    if ($browser[1] === 'IE') $browser[1] = 'Internet Explorer';
    $browser[1] = preg_replace('/Googlebot/', 'Google Bot', $browser[1]);
    if ($browser[1] === 'bingbot') $browser[1] = 'BingBot';
    // Version
    if ($browser[2] !== '') {
        $tmp = explode('.', $browser[2]);
        $browser[2] = $tmp[0] . '.' . $tmp[1];
    }

    return $browser;
}

function normalize_woothee(array $browser)
{
    // OS
    if ($browser[0] === 'UNKNOWN') $browser[0] = '';
    if ($browser[0] === 'Mac OSX') $browser[0] = 'Mac OS X';
    // Browser
    if ($browser[1] === 'UNKNOWN') $browser[1] = '';
    $browser[1] = preg_replace('/Googlebot/', 'Google Bot', $browser[1]);
    if ($browser[1] === 'bingbot') $browser[1] = 'BingBot';
    // Version
    if ($browser[2] === 'UNKNOWN') $browser[2] = '';
    if ($browser[2] !== '') {
        $tmp = explode('.', $browser[2]);
        if (count($tmp) > 2) {
            $browser[2] = $tmp[0] . '.' . $tmp[1];
        }
    }

    return $browser;
}

foreach ($parsers as $parser) {
    $input = __DIR__ . '/../cache/output-' . $parser . '.txt';
    $output = __DIR__ . '/../cache/normalized-output-' . $parser . '.txt';

    $lines = file($input);

    $newLine = '';
    foreach ($lines as $line) {
        $browser = json_decode($line);

        if ($parser === 'get_browser' || $parser === 'browscap-php' || $parser === 'crossjoin-browscap') {
            $func = 'normalize_browscap';
        } elseif ($parser === 'ua-parser') {
            $func = 'normalize_ua_parser';
        } elseif ($parser === 'woothee') {
            $func = 'normalize_woothee';
        }
        $browser = $func($browser);

        $newLine .= json_encode($browser) . "\n";
    }

    file_put_contents($output, $newLine);
}
