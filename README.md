# Artesaos - Shield
> A simple way to centralize your validation rules

## Installation
### 1 - Dependency
The first step is using composer to install the package and automatically update your `composer.json` file, you can do this by running:
```shell
composer require artesaos/shield
```

### 2 - Provider
You need to update your application configuration in order to register the package so it can be loaded by Laravel, just update your `config/app.php` file adding the following code at the end of your `'providers'` section:

> `config/app.php`

```php
// file START ommited
    'providers' => [
        // other providers ommited
        Artesaos\Shield\ShieldServiceProvider::class,
    ],
// file END ommited
```

### 3 - Facade (Optional)

In order to use the `Shield` facade, you need to register it on the `config/app.php` file, you can do that the following way:

```php
// file START ommited
    'aliases' => [
        // other Facades ommited
        'Shield' => Artesaos\Shield\Facades\Shield::class,
    ],
// file END ommited
```

### 4 - Usage

