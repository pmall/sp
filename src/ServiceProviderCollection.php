<?php

namespace Interop\Container;

use Interop\Container\Compilation\CompilerPass;
use Interop\Container\Compilation\CompilationInterface;
use Interop\Container\Compilation\FullCompilation;
use Interop\Container\Compilation\BindCompilation;
use Interop\Container\Compilation\TagCompilation;

class ServiceProviderCollection
{
    /**
     * All the app providers. Keys are shortname for easy referencing in this
     * class methods.
     *
     * @var ServiceProviderInterface[]
     */
    private $providers;

    /**
     * All the compiler passes to apply.
     *
     * @var CompilerPass[]
     */
    private $passes;

    /**
     * Set up the service provider collection with an associative array mapping
     * shortnames to service providers and an array of compiler passes to apply.
     *
     * At the moment ensure there is at least a full compiler pass when no
     * passes are given (Should probably be improved).
     *
     * @param ServiceProviderInterface[]    $providers
     * @param CompilerPass[]                $passes
     */
    public function __construct(array $providers, array $passes = [])
    {
        $this->providers = $providers;
        $this->passes = count($passes) == 0
            ? [new CompilerPass(new FullCompilation, $providers)]
            : $passes;
    }

    /**
     * Add a bind compiler pass among a subset of service providers identified
     * by the given array of shortnames.
     *
     * @param array $keys
     * @return ServiceProviderCollection
     */
    public function bind(array $keys): ServiceProviderCollection
    {
        return $this->pass(new BindCompilation, $keys);
    }

    /**
     * Add a tag compiler pass among a subset of service providers identified
     * by the given array of shortnames, tagging their aliases with the given
     * tag.
     *
     * @param string    $tag
     * @param array     $keys
     * @return ServiceProviderCollection
     */
    public function tag(string $tag, array $keys): ServiceProviderCollection
    {
        return $this->pass(new TagCompilation($tag), $keys);
    }

    /**
     * Add a compiler pass using the given compilation strategy among a subset
     * of service providers identified by the given array of shortnames. Use all
     * providers when no shortname is given.
     *
     * @param CompilationInterface  $compilation
     * @param array                 $keys
     * @return ServiceProviderCollection
     */
    public function pass(CompilationInterface $compilation, array $keys = []): ServiceProviderCollection
    {
        $providers = count($keys) > 0
            ? array_intersect_key($this->providers, array_flip($keys))
            : $this->providers;

        $passes = array_merge($this->passes, [new CompilerPass($compilation, $providers)]);

        return new ServiceProviderCollection($this->providers, $passes);
    }

    /**
     * Merge all the factories, apply compiler passes and merge the extensions.
     *
     * @return array
     */
    public function getFactories(): array
    {
        $factories = array_reduce($this->providers, function ($factories, $provider) {

            return array_merge($factories, $provider->getFactories());

        }, []);

        $factories = array_reduce($this->passes, function ($factories, $pass) {

            return array_merge($factories, $pass->getFactories());

        }, $factories);

        // extensions should be registered here.

        return $factories;
    }
}
