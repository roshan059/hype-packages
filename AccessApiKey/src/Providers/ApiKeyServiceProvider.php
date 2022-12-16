<?php
namespace Hypesewa\AccessApiKey\Providers;
// use  Hypesewa\AccessApiKey\Console\Commands\ActivateApiKey;
// use  Hypesewa\AccessApiKey\Console\Commands\DeactivateApiKey;
// use  Hypesewa\AccessApiKey\Console\Commands\DeleteApiKey;
use  Hypesewa\AccessApiKey\Console\Commands\GenerateApiKey;
// use  Hypesewa\AccessApiKey\Console\Commands\ListApiKeys;
use  Hypesewa\AccessApiKey\Http\Middleware\AuthorizeApiKey;
use Laravel\Lumen\Routing\Router;
use Illuminate\Support\ServiceProvider;
class ApiKeyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $this->registerMiddleware($router);
        $this->registerMigrations(__DIR__ . '/../../database/migrations/');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            // ActivateApiKey::class,
            // DeactivateApiKey::class,
            // DeleteApiKey::class,
            GenerateApiKey::class,
            // ListApiKeys::class,
        ]);
    }
    /**
     * Register middleware
     *
     * Support added for different Laravel versions
     *
     * @param Router $router
     */
    protected function registerMiddleware(Router $router)
    {
        $versionComparison = version_compare(app()->version(), '5.4.0');
        // dd($router);
        if ($versionComparison >= 0) {
            $router->aliasMiddleware('auth.apikey', AuthorizeApiKey::class);
        } else {
            $router->middleware('auth.apikey', AuthorizeApiKey::class);
        }
    }
    /**
     * Register migrations
     */
    protected function registerMigrations($migrationsDirectory)
    {
        // done please touch this line of code
        $this->publishes([
            $migrationsDirectory => database_path('migrations')
        ], 'migrations');
    }
}
