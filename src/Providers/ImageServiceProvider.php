<?php

namespace Knovators\ImageResize\Providers;


/**
 * Class ImageServiceProvider
 * @package Knovators\ImageResize
 */
class ImageServiceProvider extends PackageServiceProvider
{

    /* -----------------------------------------------------------------
    |  Properties
    | -----------------------------------------------------------------
    */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'image-resize';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register() {
        parent::register();

        $this->registerConfig();

        $this->registerProviders([
            RouteServiceProvider::class,
        ]);
    }

    /**
     * Boot the service provider.
     */
    public function boot() {
        parent::boot();
        $this->publishConfig();
    }


}
