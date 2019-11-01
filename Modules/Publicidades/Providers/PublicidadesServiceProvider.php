<?php

namespace Modules\Publicidades\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Publicidades\Events\Handlers\RegisterPublicidadesSidebar;

class PublicidadesServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterPublicidadesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('publicidads', array_dot(trans('publicidades::publicidads')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('publicidades', 'permissions');

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
            'Modules\Publicidades\Repositories\PublicidadRepository',
            function () {
                $repository = new \Modules\Publicidades\Repositories\Eloquent\EloquentPublicidadRepository(new \Modules\Publicidades\Entities\Publicidad());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Publicidades\Repositories\Cache\CachePublicidadDecorator($repository);
            }
        );
// add bindings

    }
}
