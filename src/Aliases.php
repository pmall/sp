<?php

namespace Interop\Container;

/**
 * Factory aliasing an array of other container entries.
 */
class Aliases
{
    private $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function __invoke($container)
    {
        return array_map([$container, 'get'], $this->ids);
    }
}
