<?php 

namespace Ortegacmanuel\ActivitystreamsLaravel;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ActivityStreamsServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->handleConfigs();
        $this->handleMigrations();
        $this->handleViews();
        // $this->handleTranslations();
        // $this->handleRoutes();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        // Bind any implementations.
        $this->registerActivities();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return [];
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/activitystreams-laravel.php';

        $this->publishes([$configPath => config_path('activitystreams-laravel.php')]);

        $this->mergeConfigFrom($configPath, 'activitystreams-laravel');
    }

    private function handleTranslations() {

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'packagename');
    }

    private function handleViews() 
    {
        $this->loadViewsFrom(__DIR__.'/views','atomfeed');        

        /*
        $this->loadViewsFrom(__DIR__.'/../views', 'packagename');

        $this->publishes([__DIR__.'/../views' => base_path('resources/views/vendor/packagename')]);
        */
    }

    private function handleMigrations() 
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
    }

    private function handleRoutes() {

        include __DIR__.'/../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function registerActivities()
    {
        $this->app->bind('activities', function($app)
        {
            return new Activity();
        });

        $this->app->bind('feed', function($app)
        {
           return new Feed;
        });        
    }    
}
