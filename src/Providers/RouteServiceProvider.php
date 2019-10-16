<?php

namespace Knovators\ImageResize\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Knovators\ImageResize\Http\Routes\ImageRoute;

/**
 * Class  RouteServiceProvider
 * @package  Knovators\ImageResize\Providers
 */
class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'Knovators\\ImageResize\\Http\\Controllers';


    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define the routes for the application.
     */
    public function map() {
        Route::namespace($this->namespace)
             ->group(function () {
                 ImageRoute::register();
             });
    }


}
