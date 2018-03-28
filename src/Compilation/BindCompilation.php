<?php

namespace Interop\Container\Compilation;

use Interop\Container\Alias;

class BindCompilation implements CompilationInterface
{
    /**
     * - Associate each alias to a concrete entry id. When an alias is
     *   associated to multiple concrete entry ids, the last one is used.
     * - Regisiter all the requirements as an alias to the alias concrete entry
     *   id when one was found at the previous step.
     *
     * This allows to "bind" requirements of a group of service providers to the
     * concrete entry ids they provides.
     *
     * @return array
     */
    public function compile(array $provided, array $required): array
    {
        $available = [];

        foreach ($provided as $id => $aliases) {

            foreach ($aliases as $alias) {

                $available[$alias] = $id;

            }

        }

        $factories = [];

        foreach ($required as $id => $alias) {

            if (isset($available[$alias])) {

                $factories[$id] = new Alias($available[$alias]);

            }

        }

        return $factories;
    }
}
