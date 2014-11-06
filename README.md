# PHP User Agent Parser Benchmarks

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

## Reference

* http://php.net/get_browser
* https://github.com/browscap/browscap-php
* https://github.com/tobie/ua-parser
* https://github.com/woothee/woothee-php
* https://github.com/crossjoin/Browscap
