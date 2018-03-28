<?php

namespace App;

use Interop\Container\ServiceProviderInterface;
use App\Cache\CacheInterface;
use App\Cache\FileCache;

class FileCacheServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [
            FileCache::class => [CacheInterface::class],
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
            FileCache::class => [self::class, 'getFileCache'],
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
     * FileCache factory.
     */
    public static function getFileCache(): FileCache
    {
        return new FileCache;
    }
}
