#!/bin/sh

cd `dirname $0`

logfile="$1"

cat "$logfile" | cut -f 6 -d '"' | sort | uniq > ua-list.txt
