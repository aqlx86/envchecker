[![Build Status](https://travis-ci.org/aqlx86/envchecker.svg?branch=master)](https://travis-ci.org/aqlx86/envchecker)

Introduction
------------

Simple Laravel 5 package that checks if your `.env` file is outdated.


Installation
------------

Add Envchecker to your composer.json file:

```composer.phar require "aqlx86/envchecker"```


Add the service provider to your Laravel application config:

```PHP
EnvChecker\EnvCheckerServiceProvider::class
```

Configuration
-------------

```
php artisan vendor:publish --provider="EnvChecker\EnvCheckerServiceProvider"
```

Update `config/envchecker.php`
```
return [
    // template env file path
    'example' => base_path('.env.example'),
    // local env file
    'local' => base_path('.env'),
    // optional env vars
    'optional' => []
];

```

Usage
-----

```
php artisan env:check
```

Sample Output

```
template file contains new values.
+------------------+---------------+
| New Keys         | Default Value |
+------------------+---------------+
| MAIL_PORT        | 2525          |
| MAIL_ENCRYPTION2 | null          |
+------------------+---------------+
```

Test
----

PHPSpec
```
./bin/phpspec run
```

Todo PHPUnit
