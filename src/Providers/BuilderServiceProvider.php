<?php

namespace Eilander\Builder\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class BuilderServiceProvider.
 */
class BuilderServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Config/Builder.php' => config_path('builder.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/Builder.php', 'builder'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('Eilander\Builder\Commands\ApiCommand');
    }
}
