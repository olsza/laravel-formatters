![Laravel Formatters](https://user-images.githubusercontent.com/37669560/139543664-89e5c4ed-0648-40c9-bccf-18e42ae4c2d0.png)

# Laravel Formatters
[![Latest Version on Packagist](https://img.shields.io/packagist/v/michael-rubel/laravel-formatters.svg?style=flat-square)](https://packagist.org/packages/michael-rubel/laravel-formatters)
[![Total Downloads](https://img.shields.io/packagist/dt/michael-rubel/laravel-formatters.svg?style=flat-square)](https://packagist.org/packages/michael-rubel/laravel-formatters)
[![Code Coverage](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/?branch=main)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/michael-rubel/laravel-formatters/run-tests?label=Tests)](https://github.com/michael-rubel/laravel-formatters/actions)
[![PHPStan](https://img.shields.io/github/workflow/status/michael-rubel/laravel-formatters/phpstan?label=Larastan)](https://github.com/michael-rubel/laravel-formatters/actions)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/michael-rubel/laravel-formatters/?branch=main)


This package is a collection of classes you can use to standardize data formats in your Laravel application.
It uses the Service Container to easily extend or override the formatter classes.

The package requires PHP ^8.0 and Laravel ^8.x.
Future versions of PHP & Laravel will be supported.

## Available formatters
- [`Date`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/DateFormatter.php)
- [`DateTime`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/DateTimeFormatter.php)
- [`TableColumn`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/TableColumnFormatter.php)
- [`LocaleNumber`](https://github.com/michael-rubel/laravel-formatters/blob/main/src/Collection/LocaleNumberFormatter.php)

... Will be more formatters soon. 😉

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
format(DateTimeFormatter::class, now()) // You can use Carbon instance or string timestamp.
```

You can use string bindings:
```php
format('table-column', 'created_at') // Returns: Created at
```

You can configure the string bindings case (snake/kebab) in the config file:
```bash
php artisan vendor:publish --tag="formatters-config"
```

### Extending formatters
Since the formatters are resolved through the Service Container they can be easily overridden by extending bindings.

For example in your Service Provider:
```php
$this->app->extend(DateTimeFormatter::class, function ($formatter) {
    $formatter->datetime_format = 'Y.m.d H:i';

    return $formatter;
});
```

- Note: You can use [Laravel Enhanced Container](https://github.com/michael-rubel/laravel-enhanced-container) package for shorter extending syntax.

### Adding custom/overriding package formatters
To add a custom formatter you should create the class that implements the `MichaelRubel\Formatters\Formatter` interface and put it to the `app/Formatters` folder.
You can put formatter with the same name as the package's to override the formatter from the package.

You can customize the folder in the config file.

## Testing
```bash
composer test
```
