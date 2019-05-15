# Passport issue proof of concept

### Configure

```shell
cp .env.example .env
php artisan key:generate
php artisan passport:keys
php artisan passport:client --personal --name=Testing
php artisan migrate
```

### Testing

```
vendor/bin/phpunit tests/Feature/AuthApiTest.php
```

### Debug Dump

[Uncomment line in AuthServiceProvider L43](https://github.com/romanzipp/Laravel-Passport-Issue/blob/master/app/Providers/AuthServiceProvider.php#L43)


### Create a user with token & print access token for manual testing

```shell
php artisan test:user-token
```
