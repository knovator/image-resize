<?php

namespace Knovators\ImageResize\Http\Routes;

/**
 * Class ImageResizeRoute
 * @package  Knovators\ImageResize\Http\Routes
 */
class ImageRoute
{

    /**
     * Register and map routes.
     */
    public static function register() {
        (new static)->map();
    }

    /**
     * Map all routes.
     */
    public function map() {

        $this->get('{all?}.{extension}', 'ImageController@imageParse')->where('all', '.*')
             ->where('extension', config("image-resize.extension"));

    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Call the router method.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments) {
        return app('router')->$name(...$arguments);
    }


}
