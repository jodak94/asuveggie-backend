<?php

namespace Modules\Ciudades\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Ciudades\Events\Handlers\RegisterCiudadesSidebar;

class CiudadesServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterCiudadesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('ciudads', array_dot(trans('ciudades::ciudads')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('ciudades', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Ciudades\Repositories\CiudadRepository',
            function () {
                $repository = new \Modules\Ciudades\Repositories\Eloquent\EloquentCiudadRepository(new \Modules\Ciudades\Entities\Ciudad());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Ciudades\Repositories\Cache\CacheCiudadDecorator($repository);
            }
        );
// add bindings

    }
}
