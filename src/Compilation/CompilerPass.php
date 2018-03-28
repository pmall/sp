<?php

namespace Interop\Container\Compilation;

class CompilerPass
{
    /**
     * The compilation strategy to apply.
     *
     * @var CompilationInterface
     */
    private $compilation;

    /**
     * The array of service providers the compilation pass is applied upon.
     *
     * @var ServiceProviderInterface[]
     */
    private $providers;

    /**
     * Set up a compilation pass with the given compilation strategy to apply
     * on the given list of service provider.
     *
     * @param CompilationInterface
     * @param ServiceProviderInterface[]
     */
    public function __construct(CompilationInterface $compilation, array $providers)
    {
        $this->compilation = $compilation;
        $this->providers = $providers;
    }

    /**
     * Collect the aliases and requirements of the service providers then apply
     * the compilation strategy.
     *
     * @return array
     */
    public function getFactories(): array
    {
        $aliases = array_reduce($this->providers, function ($aliases, $provider) {

            return array_merge($aliases, $provider->getAliases());

        }, []);

        $requirements = array_reduce($this->providers, function ($requirements, $provider) {

            return array_merge($requirements, $provider->getRequirements());

        }, []);

        return $this->compilation->compile($aliases, $requirements);
    }
}
