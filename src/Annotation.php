<?php

namespace Schischkin\DoctrineLombok;

use Cassandra\Set;
use Doctrine\Common\Annotations\Reader;
use Schischkin\DoctrineLombok\Annotations\Getter;
use Schischkin\DoctrineLombok\Annotations\Setter;

class Annotation
{
    private Reader $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function parseClassByClassName(string $className)
    {
        $class = new \ReflectionClass($className);
        // TODO: Refactor
        if ($this->hasClassAnnotation($class, Getter::class)) {
            /** @var Getter $getter */
            $getter = $this->reader->getClassAnnotation($class, Getter::class);
            $getter->addMagicMethod($class, $class->getProperties());
        }
        if ($this->hasClassAnnotation($class, Setter::class)) {
            /** @var Setter $getter */
            $setter = $this->reader->getClassAnnotation($class, Setter::class);
            $setter->addMagicMethod($class, $class->getProperties());
        }
    }

    public function parseClassByInstance(object $class)
    {
        // TODO
    }

    private function hasClassAnnotation(\ReflectionClass $class, string $annotationName): bool
    {
        return !is_null($this->reader->getClassAnnotation($class, $annotationName));
    }
}