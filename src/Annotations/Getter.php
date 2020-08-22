<?php

namespace Schischkin\Annotations;

use Doctrine\Common\Annotations\Annotation\Target;
use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target({"METHOD", "CLASS"})
 */
class Getter implements AccessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function addMagicMethod(\ReflectionClass $class, array $properties)
    {
        foreach ($properties as $property) {
            $methodName = 'get' . ucfirst($property->getName());
            if ($class->hasMethod($methodName)) {
                continue;
            }
            runkit_method_add(
                $class->getName(),
                $methodName,
                '',
                'return $this->' . $property->getName() . ';',
                RUNKIT_ACC_PUBLIC
            );
        }
    }
}