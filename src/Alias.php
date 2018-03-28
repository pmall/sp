<?php

namespace Interop\Container;

/**
 * Factory aliasing another container entry.
 */
class Alias
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __invoke($container)
    {
        return $container->get($this->id);
    }
}
