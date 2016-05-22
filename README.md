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

## Usage

Operation Shield is simple. You add locations as *namespaces*.
In the places you add files and uses namespaces to recover the files, each file contains a list of rules.

### 1 - Defining namespaces

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

### 2 - Defining rules

The rules file is quite simple, it returns an array as configuration of the own laravel.
Within this array you have a key called `rules` and within it you have up to three keys: `default`, `updating` and `creating`.

As you will see later on you can retrieve the rules with these three contexts.
The key `default` will be in all contexts. The others will merge with `default` as they are requested.

```php
# path/of/namespace/file_rule.php
return [
    'rules' => [
        'default' => [
            // default rules
        ],
        'updating' => [
            // updating rules
        ],
        'creating' => [
            // creating rules
        ],
    ],
];
```

### 3 - Recovering rules
After the namespace is properly configured you can easily retrieve the rules by combining the namespace and file name.

The `getRules` method returns an object [`Artesaos\Shield\Rules`](https://github.com/artesaos/shield/blob/master/src/Rules.php)
 based on the requested file

```php
$rules = Shield::getRules('common::client'); # path/of/namespace/client.php
$rules = app('shield')->getRules('users::post'); # path/of/users/post.php
```

```php
$rules->getDefaultRules();
$rules->getCreatingRules();
$rules->getUpdatingRules();
$rules->byRequestType($type); # post or put
```

### 4 - Trait/Models
[`Artesaos\Shield\Rules\HaRules`](https://github.com/artesaos/shield/blob/master/src/Traits/HasRules.php) is a trait to facilitate interaction with the rules from a model.

You need to import the trait for your model and set a value for the constant `rulesKey`

```php
namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Artesaos\Shield\Rules\HaRules;

class Client extends Model
{
    use HasRules;

    const rulesKey = 'common::client';
}
```

```php
$rules = Client::getRules();
```

### 5 - FormRequest

Now your validation rules are centralized, the summary is extremely simple now.

```php
namespace App\Http\Requests;

use App\Models\Client;

class ClientFormRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return Client::getRules()->byRequestType($this->getMethod());
    }
}
```