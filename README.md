<p align="center">
    <img src="https://mocsolucoes.com.br/img/web_logo.png" width="200" align="center" />
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
   Unique dependencie is a module `moc-solutions/laravel-core` (auto-install)

## How Install

* Step 1 - Use the command
    composer require `moc-solutions/laravel-auth`

* Step 2 - Edit the file `config/app.php` in array `providers` add the lines: <br />
`\MOCSolutions\Auth\AppServiceProvider::class,` <br />
 `\MOCSolutions\Core\AppServiceProvider::class,`


* Step 3 - Edit the file `config/auth.php` in array `providers.users` change model: <br />
`'model' => \APP\User::class,` to 
 `'model' => \MOCSolutions\Auth\Models\Usuario::class,`

* Step 4 - Use the command `php artisan vendor:publish`, select first `Core Provider` after `Auth Provider`.
    
* Step 5 - Add the view  [files to menu](https://gitlab.com/laravel-modules1/core/blob/master/Examples/shared) `resources/views/shared/_able-menu.blade.php` and `resources/views/shared/_able-menu-externo.blade.php`

* Step 6 - Edit the file `app/Http/Kernel.php` in array `$routeMiddleware` add the lines: <br />
`'permission' => \MOCSolutions\Auth\Middleware\Permission::class,` <br />
 `'authenticate' => \MOCSolutions\Auth\Middleware\Authenticate::class,`
        
* Step 7 -  Edit the file `app/Http/Middleware/VerifyCsrfToken.php` in array `$except` add the line: <br />
`'auth/admin/api/*'`

* Step 8 - Execute te migrate using the command `php artisan migrate`

* Step 9 - Execute the seed to create init user and permissions, using command `php artisan db:seed -class=SeedAuthSeeder`

* Step 10 - Add [the views files](https://github.com/moc-solucoes/Laravel-Core/tree/master/Examples/shared) of module on directory `resources/views`

* Step 11 - Copy the **Example Models Files** [Examples Models](https://github.com/moc-solucoes/Laravel-Auth/tree/master/Examples/app/Models/Auth) to your project, into `app/Http/Models/Auth`


**Example Models Files** [Examples Models](https://github.com/moc-solucoes/Laravel-Auth/tree/master/Examples/app/Models/Auth).

**Example menus** [Examples Menus](https://github.com/moc-solucoes/Laravel-Core/tree/master/Examples/shared).
 
## License
This library is released under the [AGPL-3.0 license](https://github.com/moc-solucoes/Laravel-Auth/blob/master/LICENSE).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Auth, please send an e-mail to MOC Soluções via [contato@mocsolucoes.com.br](mailto:contato@mocsolucoes.com.br). All security vulnerabilities will be promptly addressed.

## Maintained by

This library is maintained by [MOC SOLUÇÕES](http://mocsolucoes.com.br).