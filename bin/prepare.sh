#!/bin

cd `dirname $0`

chmod o+w ../cache/*.txt

php ../vendor/bin/uaparser.php ua-parser:update

php ../benchmarks/browscap-php.php

php update-crossjoin-browscap.php
