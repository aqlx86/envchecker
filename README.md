Introduction
------------

Simple Laravel 5 package that checks if your `.env` file is outdated.


Installation
------------

Add Envchecker to your composer.json file:

```composer.phar require "iverberk/larasearch```


Add the service provider to your Laravel application config:

```PHP
'Aqlx86\EnvChecker\EnvCheckerServiceProvider::class,'
```

Create config
```
php artisan vendor:publish
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
