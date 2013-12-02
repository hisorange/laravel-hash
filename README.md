## Replace the BCrypt hashing with native PHP hashing algorithm for Laravel.

With this you don't need BCrypt support and even can choose which algorithm to use with a single config option.

##### Installation with composer:

```json
"require": {
	"hisorange/hash": "dev-master"
}
```

After the composer update replace the HashServiceProvider in your app.php:

```php
'providers'	=> array(
	// ...
	#'Illuminate\Hashing\HashServiceProvider',
	'hisorange\hash\Providers\HashServiceProvider',
	// ...
)
```

You can use personal configurations just publish the package's configuration files.

```
php artisan config:publish hisorange/hash
```

In the configurations you can choose which algorithm to use, added salt length and the alphabet characters for the salting.

Inspired by the [robclancy/laravel4-hashing](https://github.com/robclancy/laravel4-hashing) repo :3
