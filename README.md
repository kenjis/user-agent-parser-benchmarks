# PHP User Agent Parser Benchmarks

## Results

**The results turned out to be misleading. I'll fix the benchmarks.**

|parser            |time               |peak memory|
|------------------|-------------------|----------:|
|[get_browser()](http://php.net/get_browser)                |46.237493991852    |524288     |
|[browscap-php](https://github.com/browscap/browscap-php)   | 0.95736503601074  |13369344   |
|[crossjoin\Browscap](https://github.com/crossjoin/Browscap)| 2.8503410816193   |1310720    |
|[ua-parser](https://github.com/tobie/ua-parser)            | 0.10208678245544  |786432     |
|[woothee-php](https://github.com/woothee/woothee-php)      | 0.0087931156158447|524288     |

## How to Benchmark

Install source code.

~~~
$ git clone https://github.com/kenjis/user-agent-parser-benchmarks.git
$ cd user-agent-parser-benchmarks
$ composer install
~~~

Edit `baseUrl` value in `config.php` if you need.

Prepare benchmarks and web server.

~~~
$ sh bin/prepare.sh
$ php -S localhost:8000
~~~

Run benchmarks.

~~~
$ php bin/run-benchmarks.php
~~~

See <http://localhost:8000/benchmark.php>.

## Check your User Agent

You can check your user agent at <http://localhost:8000/check-your-ua.php>.

## How to Check Differences of Detections

Prepare your user agent strings list file and set `userAgentListFile` value in `config.php`.

Run benchmarks and normalize.

~~~
$ php bin/run-benchmarks.php
$ php bin/normalize-output.php
~~~

Show differences.

~~~
$ php bin/show-diff.php
~~~

## Reference

* http://php.net/get_browser
* https://github.com/browscap/browscap-php
* https://github.com/crossjoin/Browscap
* https://github.com/tobie/ua-parser
* https://github.com/woothee/woothee-php
