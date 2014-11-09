# PHP User Agent Parser Benchmarks

## Results

|parser            |time               |peak memory|
|------------------|-------------------|----------:|
|get_browser()     |46.237493991852    |524288     |
|browscap-php      | 0.95736503601074  |13369344   |
|crossjoin\Browscap| 2.8503410816193   |1310720    |
|ua-parser         | 0.10208678245544  |786432     |
|woothee-php       | 0.0087931156158447|524288     |

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

## Reference

* http://php.net/get_browser
* https://github.com/browscap/browscap-php
* https://github.com/crossjoin/Browscap
* https://github.com/tobie/ua-parser
* https://github.com/woothee/woothee-php
