<?php

namespace Interop\Container\Compilation;

interface CompilationInterface
{
    /**
     * Return an associative array mapping container entry id to factories by
     * applying a compilation strategy upon the given aliases and requirements.
     *
     * @param array $provided maps concrete entry ids to arrays of alias names.
     * @param array $required maps service provider specific ids to alias names.
     * @return array
     */
    public function compile(array $provided, array $required): array;
}
