#!/bin

cd `dirname $0`

chmod o+w ../cache/*.txt

echo "Updating ua-parser data..."
php ../vendor/bin/uaparser.php ua-parser:update

echo "Updating browscap-php data..."
php update-browscap-php.php

echo "Updating crossjoin-browscap data..."
php update-crossjoin-browscap.php
