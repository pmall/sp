<?php

namespace App;

use App\Cache\CacheInterface;

class WeatherApi
{
    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function description(): string
    {
        return sprintf('WeatherApi using %s', get_class($this->cache));
    }
}
