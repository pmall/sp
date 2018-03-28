<?php

namespace Interop\Container;

interface ServiceProviderInterface
{
    /**
     * Return an associative array mapping container entry ids provided by this
     * service provider getFactories method to an array of aliases.
     *
     * The keys of this array _must_ be present among the keys of the array
     * returned by the getFactories method. Ideally aliases are interface names.
     *
     * @return array
     */
    public function getAliases(): array;

    /**
     * Return an associative array mapping container entry ids specific to this
     * service provider to alias names.
     *
     * The keys of this array _must_ not be interface names. Ideally those are
     * strings prepended with the package name and vendor, ensuring uniqueness.
     *
     * @return array
     */
    public function getRequirements(): array;

    /**
     * Return an associative array mapping container entry ids to factories.
     *
     * The keys of this array _must_ not be interface names. Ideally those are
     * either this package class names or strings prepended with the package
     * name and vendor, ensuring uniqueness.
     *
     * @return array
     */
    public function getFactories(): array;

    /**
     * Return an associative array mapping container entry ids to extensions.
     *
     * @return array
     */
    public function getExtensions(): array;
}
