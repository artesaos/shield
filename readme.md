# Artesaos - Shield

Artesãos Shield provides you a simple way to centralize your validation rules. It was mainly designed to solve the FormRequest rules practice, that is valid outside HTTP requests.


### Installing
The package installation can be done with composer by the following command:

```shell
composer require artesaos/shield
```

Shield **does not** provides Facades or ServiceProviders, they aren't needed.

## Usage

#### 1 - Defining Rules
Operating Shield is simple. It starts by defining a rules class for your model or other kind of entity. Take a look on the following example:

```php
<?php

namespace App\Domains\Users\Rules;

use Artesaos\Shield\Rules

class UserRules extends Rules
{
	public function defaultRules()
	{
		return [
			'name' => 'required|min:6',
		];
	}

	public function creating($callback=null)
	{
		// returnRules method should be used
		// whenever the rules should be merged
		// with the default ones.
		return $this->returnRules([
			'email' => 'required|email',
		], $callback);
	}

	// any other methods / actions that needs rules

}
```

#### 2 - Enabling Rules
You could instantiate the rules by hand, but the recommended way of doing it is setting a static property into the class that owns the rules and using the proper trait


```php
<?php

// some other use statements here
use Artesaos\Shield\HasRules;
use App\Domains\Users\Rules\UserRules;

class User extends Model
{
	// using the rules trait
	use HasRules;

	// setting the rules class
	protected static $rulesFrom = UserRules::class

	// some model stuff here
}
```




#### 3 - Usage

Whenever you need to access the rules, you can do it by creating a new instance of the rules class, or just using the classes (mainly models) you enabled.

```php
User::rules()->creating();

User::rules()->updating();

User::rules()->yourCustomMethodForACustomAction();

User::rules()->whatever();
```


A really nice way of using it inside FormRequests are by passing the current HTTP method, that will be translated to the corresponding rules method (that's a convention)


```php

// inside a form request
User::rules()->byRequestType($this->getMethod());

// wherever you have a request instance
User::rules()->byRequestType($request->getMethod());


```

## Credits

- Author: [@vinicius73](https://github.com/vinicius73)
- Version 1 Refactoring [@hernandev](https://github.com/hernandev)
- License: MIT
