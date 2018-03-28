<?php

namespace Interop\Container\Compilation;

use Interop\Container\Aliases;

class TagCompilation implements CompilationInterface
{
    /**
     * The tag to use during the compilation.
     *
     * @var string
     */
    private $tag;

    /**
     * Set up a tag compilation strategy with the given tag.
     *
     * @param string $tag
     */
    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Register under the same id an array of the concrete entries of each alias.
     *
     * For example when multiple service providers expose a 'something' alias,
     * an array of 'something' services are registered under the 'something[tag]'
     * entry of the container.
     *
     * @return array
     */
    public function compile(array $provided, array $required): array
    {
        $tagged = [];

        foreach ($provided as $id => $aliases) {

            foreach ($aliases as $alias) {

                $tag = sprintf('%s[%s]', $alias, $this->tag);

                if (! in_array($id, $tagged[$tag] ?? [])) {

                    $tagged[$tag][] = $id;

                }

            }

        }

        $factories = [];

        foreach ($tagged as $id => $aliases) {

            $factories[$id] = new Aliases($aliases);

        }

        return $factories;
    }
}
