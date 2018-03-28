<?php

namespace App;

use Interop\Container\ServiceProviderInterface;
use App\Cache\CacheInterface;

class WeatherApiServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getRequirements(): array
    {
        return [
            'moufmouf.weatherapi.cache' => CacheInterface::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFactories(): array
    {
        return [
            WeatherApi::class => [self::class, 'getWeatherApi'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getExtensions(): array
    {
        return [];
    }

    /**
     * WeatherApi factory.
     */
    public static function getWeatherApi($container)
    {
        // A local alias is used instead of an interface name.
        // This local alias may be bound to a specific concrete implementation.
        $cache = $container->get('moufmouf.weatherapi.cache');

        return new WeatherApi($cache);
    }
}
