#!/bin

cd `dirname $0`

php ../vendor/bin/uaparser.php ua-parser:update

php ../benchmarks/browscap-php.php

php ../benchmarks/crossjoin-browscap.php
