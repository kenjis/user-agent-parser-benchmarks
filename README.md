# PHP User Agent Parser Benchmarks

## Results

|parser            |time            |peak memory|
|------------------|----------------|----------:|
|get_browser()     |47.569047927856 |524288     |
|browscap-php      |1.1221010684967 |13631488   |
|crossjoin\Browscap|3.0749452114105 |1572864    |
|ua-parser         |0.13834619522095|786432     |
|woothee-php       |0.19455099105835|524288     |

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
* https://github.com/tobie/ua-parser
* https://github.com/woothee/woothee-php
* https://github.com/crossjoin/Browscap
