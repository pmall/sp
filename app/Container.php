<?php

namespace App;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    private $factories;
    private $cache;

    public function __construct(array $factories)
    {
        $this->factories = $factories;
        $this->cache = [];
    }

    public function get($id)
    {
        if ($this->has($id)) {

            $service = $this->cache[$id] ?? $this->factories[$id]($this);

            return $this->cache[$id] = $service;

        }

        throw new class ($id) extends \Exception implements NotFoundExceptionInterface
        {
            public function __construct($id) {

                parent::__construct(sprintf('entry not found: %s', $id));

            }
        };
    }

    public function has($id)
    {
        return isset($this->factories[$id]);
    }
}
