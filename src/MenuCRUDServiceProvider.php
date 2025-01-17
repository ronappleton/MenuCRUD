<?php

namespace Backpack\MenuCRUD;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Backpack\MenuCRUD\app\Models\Menu;
use Backpack\MenuCRUD\app\Models\MenuItem;
use Backpack\MenuCRUD\app\Observers\MenuObserver;
use Backpack\MenuCRUD\app\Observers\MenuItemObserver;
use Backpack\MenuCRUD\app\Http\ViewComposers\NavigationViewComposer;

class MenuCRUDServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
     *
     * @var string
     */
    public $routeFilePath = '/routes/backpack/menucrud.php';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // make menus available in views
        View::composer('*', NavigationViewComposer::class);

        // publish migrations
        $this->publishes([__DIR__.'/database/migrations' => database_path('migrations')], 'migrations');
        $this->publishes([__DIR__.'/config/menus.php' => config_path('menus.php'),]);

        $viewPublishPath = resource_path('views') . '/vendor/backpack/menuCrud';
        $viewModulePath = __DIR__.'/resources/views/menus';

        $this->publishes([$viewModulePath => $viewPublishPath]);

        if (File::isDirectory($viewPublishPath)) {
            $this->loadViewsFrom($viewPublishPath, 'menucrud');
        } else {
            $this->loadViewsFrom($viewModulePath, 'menucrud');
        }


        if (config('menus.invalidated_caches')) {
            Menu::observe(MenuObserver::class);
            MenuItem::observe(MenuItemObserver::class);
        }
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // by default, use the routes file provided in vendor
        $routeFilePathInUse = __DIR__.$this->routeFilePath;

        // but if there's a file with the same name in routes/backpack, use that one
        if (file_exists(base_path().$this->routeFilePath)) {
            $routeFilePathInUse = base_path().$this->routeFilePath;
        }

        $this->loadRoutesFrom($routeFilePathInUse);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupRoutes($this->app->router);
    }

}
