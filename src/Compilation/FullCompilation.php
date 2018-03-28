<?php

namespace Interop\Container\Compilation;

use Interop\Container\Alias;

class FullCompilation implements CompilationInterface
{
    /**
     * Apply a full compilation strategy:
     * - Register all the aliases. When many aliases have the same name, the
     *   last one erase the others.
     * - Regisiter all the requirements as an alias to their associated alias
     *   name, so they are aliasing the default concrete entry is of this alias.
     *
     * This ends up with the same behavior as the 0.4.0 version of service
     * provider interop.
     *
     * @return array
     */
    public function compile(array $provided, array $required): array
    {
        $factories = [];

        foreach ($provided as $id => $aliases) {

            foreach ($aliases as $alias) {

                $factories[$alias] = new Alias($id);

            }

        }

        foreach ($required as $local_alias => $alias) {

            $factories[$local_alias] = new Alias($alias);

        }

        return $factories;
    }
}
