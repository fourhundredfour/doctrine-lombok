<?php

namespace Schischkin\DoctrineLombok\Annotations;

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
        foreach ($properties as $property) {
            $methodName = 'set' . ucfirst($property->getName());
            if ($class->hasMethod($methodName)) {
                continue;
            }
            \runkit7_method_add(
                $class->getName(),
                $methodName,
                '$value',
                '$this->' . $property->getName() . ' = $value;'
            );
        }
    }
}