<?php
namespace Hypesewa\AccessApiKey\Providers;
use  Hypesewa\AccessApiKey\Console\Commands\ActivateApiKey;
use  Hypesewa\AccessApiKey\Console\Commands\DeactivateApiKey;
use  Hypesewa\AccessApiKey\Console\Commands\DeleteApiKey;
use  Hypesewa\AccessApiKey\Console\Commands\GenerateApiKey;
use  Hypesewa\AccessApiKey\Console\Commands\ListApiKeys;
// use Laravel\Lumen\Routing\Router;
// use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\ServiceProvider;
class ApiKeyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
 
     * @return void
     */
    public function boot()
    {
        // $this->registerMiddleware($couter);
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
            ActivateApiKey::class,
            DeactivateApiKey::class,
            DeleteApiKey::class,
            GenerateApiKey::class,
            ListApiKeys::class,
        ]);
    }
    /**
     * Register middleware
     *
     * Support added for different Laravel versions
     *
     * @param Router $router
     */
    // protected function registerMiddleware(Controller $couter)
    // {
    //     $versionComparison = version_compare(app()->version(), '5.4.0');
    //     // dd($router);
    //     dd(AuthorizeApiKey::class);
    //     if ($versionComparison >= 0) {
     
    //         $couter->aliasMiddleware('auth.apikey', AuthorizeApiKey::class);
    //     } else {
    //         $couter->middleware('auth.apikey', AuthorizeApiKey::class);
    //     }
    // }
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
