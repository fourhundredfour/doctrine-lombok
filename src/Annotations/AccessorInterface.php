<?php

namespace Schischkin\DoctrineLombok\Annotations;

interface AccessorInterface
{
    /**
     * Adds magic method to the class for the required properties
     *
     * @param \ReflectionClass $class
     * @param \ReflectionProperty[] $properties
     * @return mixed
     */
    public function addMagicMethod(\ReflectionClass $class, array $properties);
}