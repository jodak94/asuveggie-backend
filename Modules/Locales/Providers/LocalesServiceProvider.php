<?php

namespace Modules\Locales\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Locales\Events\Handlers\RegisterLocalesSidebar;

class LocalesServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterLocalesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('locals', array_dot(trans('locales::locals')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('locales', 'permissions');

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
            'Modules\Locales\Repositories\LocalRepository',
            function () {
                $repository = new \Modules\Locales\Repositories\Eloquent\EloquentLocalRepository(new \Modules\Locales\Entities\Local());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Locales\Repositories\Cache\CacheLocalDecorator($repository);
            }
        );
// add bindings

    }
}
