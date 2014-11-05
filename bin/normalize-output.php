<?php

$parsers = array('browscap-php', 'ua-parser', 'woothee');

foreach ($parsers as $parser) {
    $input = __DIR__ . '/../cache/output-' . $parser . '.txt';
    $output = __DIR__ . '/../cache/normal-output-' . $parser . '.txt';
    
    $lines = file($input);
    
    $newLine = '';
    foreach ($lines as $line) {
        $browser = json_decode($line);
        
        // OS
        if ($browser[0] === 'unknown') $browser[0] = '';
        if ($browser[0] === 'Win2000') $browser[0] = 'Windows 2000';
        if ($browser[0] === 'WinXP') $browser[0] = 'Windows XP';
        if ($browser[0] === 'WinVista') $browser[0] = 'Windows Vista';
        if ($browser[0] === 'Win7') $browser[0] = 'Windows 7';
        if ($browser[0] === 'Win8') $browser[0] = 'Windows 8';
        if ($browser[0] === 'Win8.1') $browser[0] = 'Windows 8.1';
        if ($browser[0] === 'MacOSX') $browser[0] = 'Mac OS X';
        
        if ($browser[0] === 'Other') $browser[0] = '';
        
        if ($browser[0] === 'UNKNOWN') $browser[0] = '';
        if ($browser[0] === 'Mac OSX') $browser[0] = 'Mac OS X';
        
        // Browser
        if ($browser[1] === 'Default Browser') $browser[1] = '';
        if ($browser[1] === 'IE') $browser[1] = 'Internet Explorer';
        
        if ($browser[1] === 'Other') $browser[1] = '';
        
        if ($browser[1] === 'UNKNOWN') $browser[1] = '';
        
        // Version
        if ($browser[2] === '0.0') $browser[2] = '';
        
        if ($browser[2] === 'UNKNOWN') $browser[2] = '';
        
        $newLine .= json_encode($browser) . "\n";
    }
    
    file_put_contents($output, $newLine);
}
