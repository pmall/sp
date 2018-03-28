<?php

namespace App;

use Interop\Container\ServiceProviderInterface;
use App\Cache\CacheInterface;
use App\Cache\RedisCache;

class RedisCacheServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [
            RedisCache::class => [CacheInterface::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getRequirements(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getFactories(): array
    {
        return [
            RedisCache::class => [self::class, 'getRedisCache'],
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
     * RedisCache factory
     */
    public static function getRedisCache(): RedisCache
    {
        return new RedisCache;
    }
}
