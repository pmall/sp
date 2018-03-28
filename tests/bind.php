<?php

use App\Container;
use Interop\Container\ServiceProviderCollection;

require './vendor/autoload.php';

$collection = new ServiceProviderCollection([
    'cache.file' => new App\FileCacheServiceProvider,
    'cache.redis' => new App\RedisCacheServiceProvider,
    'weatherapi' => new App\WeatherApiServiceProvider,
]);

$collection = $collection->bind(['cache.file', 'weatherapi']);

$container = new Container($collection->getFactories());

// tests

echo '- Default cache should be redis cache.' . "\n";
$cache = $container->get(App\Cache\CacheInterface::class);
echo '  ' . sprintf('%s => %s', App\Cache\CacheInterface::class, get_class($cache)) . "\n\n";

echo '- WeatherApi should use file cache.' . "\n";
echo '  ' . $container->get(App\WeatherApi::class)->description() . "\n\n";

echo sprintf('- %s[tagged.caches] entry should not be registered', App\Cache\CacheInterface::class) . "\n";

try {

    $tagged = $container->get(sprintf('%s[tagged.caches]', App\Cache\CacheInterface::class));

    echo '  ' . implode(', ', array_map('get_class', $tagged)) . "\n";

}

catch (Exception $e) {

    echo '  ' . $e->getMessage() . "\n";

}
