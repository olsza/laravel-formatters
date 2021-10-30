This package is a collection of formatters you can use to standardize data formats in your Laravel application.

The package requires PHP 8.0 and Laravel 8.x.
Future versions of PHP & Laravel will be supported.

## Available formatters
- `Date`
- `DateTime`
- `TableColumn`

## Contributing
If you have written your own formatter and want to add it to this package, PRs are welcomed.
- Note: PRs won't be accepted without tests!

## Installation
You can install the package via composer:

```bash
composer require michael-rubel/laravel-formatters
```

## Usage

```php
format(DateTimeFormatter::class, now()->addMonth())
format(DateTimeFormatter::class, '2022-12-25 00:00:00')
format(DateTimeFormatter::class, ['to_format' => '2022-12-25 00:00:00'])
```

Use can pass snake cased string instead of class:
```php
format('date_time', '2022-12-25 00:00:00') // 2022-12-25 00:00
format('table_column', 'created_at') // Created at
```

### Extending package formatters
Because the formatters are resolved through the Service Container they can be easily overridden by extending bindings.

For example in your Service Provider:
```php
$this->app->extend(DateTimeFormatter::class, function ($service) {
    $service->datetime_format = 'Y.m.d H:i';

    return $service;
});
```

- Note: You can use [Laravel Enhanced Container](https://github.com/michael-rubel/laravel-enhanced-container) package for shorter extending syntax.

### Overriding package formatters
You can put formatter with the same name as the package's to your `App\Formatters` class by default. If you want to change this directory, you can publish the config and point the directory as you wish.

Publish the config using this command:
```bash
php artisan vendor:publish --tag="formatters-config"
```

## Testing
```bash
composer test
```
