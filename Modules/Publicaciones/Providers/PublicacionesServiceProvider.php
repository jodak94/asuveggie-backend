<?php

namespace Modules\Publicaciones\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Publicaciones\Events\Handlers\RegisterPublicacionesSidebar;

class PublicacionesServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterPublicacionesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('publicacions', array_dot(trans('publicaciones::publicacions')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('publicaciones', 'permissions');

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
            'Modules\Publicaciones\Repositories\PublicacionRepository',
            function () {
                $repository = new \Modules\Publicaciones\Repositories\Eloquent\EloquentPublicacionRepository(new \Modules\Publicaciones\Entities\Publicacion());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Publicaciones\Repositories\Cache\CachePublicacionDecorator($repository);
            }
        );
// add bindings

    }
}
