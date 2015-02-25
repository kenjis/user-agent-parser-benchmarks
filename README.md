# PHP User Agent Parser Benchmarks

## Results

|parser            |time               |peak memory|
|------------------|-------------------|----------:|
|[get_browser()](http://php.net/get_browser)                |59.665177 |524288  |
|[browscap-php](https://github.com/browscap/browscap-php)   | 4.9851598|50069504|
|[crossjoin\Browscap](https://github.com/crossjoin/Browscap)| 4.6786639|1310720 |
|[ua-parser](https://github.com/ua-parser/uap-php)          | 0.6419560|2097152 |
|[woothee-php](https://github.com/woothee/woothee-php)      | 0.0876269|524288  |

Note(1): These parsers have different functionality. Generally speaking, it has more functionality, it becomes slower.

Note(2): This benchmark is designed to parse only one user agent with one parser instance.

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
* https://github.com/ua-parser/uap-php
* https://github.com/woothee/woothee-php
