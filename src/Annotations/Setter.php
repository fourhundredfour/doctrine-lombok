<?php

namespace Schischkin\Annotations;

use Doctrine\Common\Annotations\Annotation\Target;
use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target({"METHOD", "CLASS"})
 */
class Setter implements AccessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function addMagicMethod(\ReflectionClass $class, array $properties)
    {
        // TODO: Implement addMagicMethod() method.
    }
}