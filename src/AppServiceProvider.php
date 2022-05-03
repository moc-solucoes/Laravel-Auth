<?php

namespace MOCSolutions\Auth;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Route;
use MOCSolutions\Auth\Middleware\AuthenticateApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . DS . '..' . DS . 'routes' . DS . 'web.php');
        if (env('AUTH_MOBILE')) $this->loadRoutesFrom(__DIR__ . DS . '..' . DS . 'routes' . DS . 'api.php');
        $this->loadViewsFrom(__DIR__ . DS . 'Views', 'Auth');
        $this->loadMigrationsFrom(__DIR__ . DS . '..' . DS . 'database' . DS . 'migrations');
        $this->mergeConfigFrom(__DIR__ . DS . '..'.DS.'configs' . DS . 'services.php', 'services');
    }
    private function publish()
    {
        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders'),
        ], ['auth-seeders']);


        $this->publishes([
           __DIR__ . DS . '..' . DS . 'public' => public_path()
        ], 'auth-public');

        return $this;
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publish()->mapWebRoutes();

        if (env('AUTH_MOBILE')) $this->mapApiRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . DS . '..' . DS . 'routes' . DS . 'web.php');

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', AuthenticateApi::class])
            ->namespace($this->namespace)
            ->group(__DIR__ . DS . '..' . DS . 'routes' . DS . 'api.php');
    }
}
