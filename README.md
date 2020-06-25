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

* Step 1 - Use the command
    composer install `moc-solutions/laravel-core`

* Step 2 - Edit the file `config/app.php` in array `providers` add the lines: <br />
`\MOCSolutions\Auth\AppServiceProvider::class,` <br />
 `\MOCSolutions\Core\AppServiceProvider::class,`

* Step 3 - Use the command `php artisan vendor:publish`, select first `Core Provider` after `Auth Provider`.
    
* Step 4 - Add the view  [files to menu](https://gitlab.com/laravel-modules1/core/blob/master/Examples/shared) `resources/views/shared/_able-menu.blade.php` and `resources/views/shared/_able-menu-externo.blade.php`

* Step 5 - Edit the file `app/Http/Kernel.php` in array `$routeMiddleware` add the lines: <br />
`'permission' => \MOCSolutions\Auth\Middleware\Permission::class,` <br />
 `'authenticate' => \MOCSolutions\Auth\Middleware\Authenticate::class,`
        
* Step 6 - Add [the views files](https://github.com/moc-solucoes/Laravel-Core/tree/master/Examples/shared) of module on directory `resources/vuews`


**Example Models Files** [Examples Models](https://gitlab.com/laravel-modules1/auth/blob/master/Examples/app/Models).

**Example menus** [Examples Menus](https://gitlab.com/laravel-modules1/core/blob/master/Examples/shared).
 
## Security Vulnerabilities

If you discover a security vulnerability within Laravel Auth, please send an e-mail to MOC Soluções via [contato@mocsolucoes.com.br](mailto:contato@mocsolucoes.com.br). All security vulnerabilities will be promptly addressed.

## Maintained by

This library is maintained by [MOC SOLUÇÕES](http://mocsolucoes.com.br).