<?php

namespace Cloudmazing\Tikkie;

use Illuminate\Support\ServiceProvider;

/**
 * Class TikkieServiceProvider.
 *
 * @category ServiceProvider
 * @author   Job Wiegant <job@cloudmazing.nl>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class TikkieServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge the package configuration file with the application's published copy.
        $this->mergeConfigFrom(__DIR__.'/../config/tikkie.php', 'tikkie');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            // Publishing the configuration file. Use :
            // php artisan vendor:publish --tag=tikkie-config
            $this->publishes(
                [
                    __DIR__.'/../config/tikkie.php' => config_path('tikkie.php'),
                ],
                'tikkie-config'
            );
        }

        // The singleton method binds a class or interface into the container
        // that should only be resolved one time. Once a singleton binding is resolved,
        // the same object instance will be returned on subsequent calls into the container
        $this->app->singleton('tikkie', function () {
            return new Tikkie;
        });
    }
}
