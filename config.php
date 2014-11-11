<?php

// global config
$config = array(
    'cacheDir' => __DIR__ . '/cache',
    'userAgentListFile' => __DIR__ . '/data/ua-list-100-sample01.txt',
//    'userAgentListFile' => __DIR__ . '/data/ua-list-all.txt',
    'parseAll' => true,

    'baseUrl' => 'http://localhost:8000',
//    'baseUrl' => 'http://localhost/user-agent-parser-benchmarks/',

    'parsers' => array(
        'get_browser', 'browscap-php', 'crossjoin-browscap', 'ua-parser', 'woothee',
    ),
    // function names without prefix `normalize_` to normalize outputs
    // used in `bin/normalize-output.php`
    'normalizer' => array(
        'browscap', 'browscap', 'browscap', 'ua_parser', 'woothee',
    ),
);
