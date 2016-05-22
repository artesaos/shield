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

### Usage

Operation Shield is simple. You add locations as *namespaces*.
In the places you add files and uses namespaces to recover the files, each file contains a list of rules.

#### 1 - Defining namespaces

The initial setting is very simple, you determine the folder and the corresponding namespace.

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $path = __DIR__ . '/../shield/';
        $this->app['shield']
             ->addRulesNamespace($path, 'common') # app/shield/
             ->addRulesNamespace($path . 'users', 'users'); # app/shield/users
            // addRulesNamespace($path, $namespace);
    }
    // ommited
}
```

Shield is designed to be modular, you can define different namespaces in different service providers

```php
namespace App\Domains\Users\Providers;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        # /app/Domains/Users/rules
        $this->app['shield']->addRulesNamespace(__DIR__ . '/../rules', 'users');
    }

    // ommited
}
```

