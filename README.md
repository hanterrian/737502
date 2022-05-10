## Laravel project

Additional packages

- Laravel-Ide
- l5-swagger
- php-cs-fixer
- laravel-permission
- laravel-sluggable

Main site
http://737502.test

Api auth based on bearer token

[Postman collections](737502.postman_collection.json)

### Deployment

Used default sail

```
composer install
./vendow/bin/sail up -d
./vendor/bin/sail artisan db:seed
```

in hosts add

```
127.0.0.1       737502.test
```

### Admin login & password

**email:** admin@737502.test

**password:** password

### User login & password

**email:** user@737502.test

**password:** password
