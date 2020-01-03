<p align="center">
    <img src="https://mocsolucoes.com.br/logo" width="200" align="center" />
</p>

## About Auth Module

Authenticate module is a module on Laravel framework, have the functions listed here:

- Login, Logout, Register, Recovery Password
- Permissions engine
- Crud Users
- Crud Permissions (roles)
- Crud Profiles

This module is private, exclusive using on [MOC Solutions](https://mocsolucoes.com.br).

## Dependencies
   Unique dependencie is a module `moc-solutions/laravel-core`

## How Install

* Step 1 - Add the code in your file composer.json on project.
<pre>   
    "repositories": [
        {
            "type": "gitlab",
            "url": "https://gitlab.com/laravel-modules1/auth.git"
        },
        {
            "type": "gitlab",
            "url": "https://gitlab.com/laravel-modules1/core.git"
        }
    ],
    "require": {
        "moc-solucoes/laravel-auth": "dev-master",
    }
</pre> 

* Step 2 - Use the command    
    `composer install`

* Step 3 - Edit the file `config/app.php` in array `providers` add the lines: <br />
`\MOCSolutions\Auth\AppServiceProvider::class,` <br />
 `\MOCSolutions\Core\AppServiceProvider::class,`

* Step 4 - Use the command `php artisan vendor:publish`, select first `Core Provider` after `Auth Provider`.
    
* Step 5 - Add the view  [files to menu](https://gitlab.com/laravel-modules1/core/blob/master/Examples/shared) `resources/views/shared/_able-menu.blade.php` and `resources/views/shared/_able-menu-externo.blade.php`

* Step 6 - Edit the file `app/Http/Kernel.php` in array `$routeMiddleware` add the lines: <br />
`'permission' => \MOCSolutions\Auth\Middleware\Permission::class,` <br />
 `'authenticate' => \MOCSolutions\Auth\Middleware\Authenticate::class,`
        
* Step 7 - Add [the models files](https://gitlab.com/laravel-modules1/core/blob/master/Examples/shared) of module on directory `app/Http/Models`


**Example Models Files** [Examples Models](https://gitlab.com/laravel-modules1/auth/blob/master/Examples/app/Http/Models).

**Example menus** [Examples Menus](https://gitlab.com/laravel-modules1/core/blob/master/Examples/shared).
 
 
In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [contato@mocsolucoes.com.br](mailto:contato@mocsolucoes.com.br). All security vulnerabilities will be promptly addressed.

## Maintained by

This library is maintained by [MOC SOLUÇÕES](http://mocsolucoes.com.br).