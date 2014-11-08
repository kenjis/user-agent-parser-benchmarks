#!/bin/sh

cd `dirname $0`

logfile="$1"

grep -v "/assets/" "$logfile" | grep -v "/favicon.ico" | grep -v "/robots.txt" \
 | cut -f 6 -d '"' | grep -v '^-' | head -100
exit

cat "$logfile" | cut -f 6 -d '"' | sort | uniq | sort > ua-list.txt
