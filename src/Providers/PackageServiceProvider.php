<?php

namespace Knovators\ImageResize\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;
use ReflectionClass;

/**
 * Class PackageServiceProvider
 *
 * @package  Knovators\ImageResize\Laravel
 */
abstract class PackageServiceProvider extends ServiceProvider
{


    protected $ds = DIRECTORY_SEPARATOR;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Vendor name.
     *
     * @var string
     */
    protected $vendor = 'knovators';

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = '';

    /**
     * Package base path.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Merge multiple config files into one instance (package name as root key)
     *
     * @var bool
     */
    protected $multiConfigs = false;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new service provider instance.
     *
     * @param Application $app
     * @throws \ReflectionException
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->basePath = $this->resolveBasePath();
    }

    /**
     * Resolve the base path of the package.
     *
     * @return string
     * @throws \ReflectionException
     */
    protected function resolveBasePath()
    {
        return dirname(
            (new ReflectionClass($this))->getFileName(), 2
        );
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Get config folder.
     *
     * @return string
     */
    protected function getConfigFolder()
    {
        return realpath($this->getBasePath().$this->ds.'config');
    }

    /**
     * Get config key.
     *
     * @return string
     */
    protected function getConfigKey()
    {
        return Str::slug($this->package);
    }

    /**
     * Get config file path.
     *
     * @return string
     */
    protected function getConfigFile()
    {
        return $this->getConfigFolder().$this->ds."{$this->package}.php";
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();
    }

    /* -----------------------------------------------------------------
     |  Package Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register configs.
     *
     * @return
     */
    protected function registerConfig()
    {
        return $this->mergeConfigFrom($this->getConfigFile(), $this->getConfigKey());
    }


    /**
     * Publish the config file.
     */
    protected function publishConfig()
    {
        $this->publishes([
            $this->getConfigFile() => $this->getConfigFileDestination()
        ], 'config');
    }

    /**
     * Get config file destination path.
     *
     * @return string
     */
    protected function getConfigFileDestination()
    {
        return config_path("{$this->package}.php");
    }
}
