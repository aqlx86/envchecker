# envchecker


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