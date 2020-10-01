<?php

namespace Schischkin\DoctrineLombok;

use Doctrine\Common\Annotations\Reader;
use Schischkin\DoctrineLombok\Annotations\AccessorInterface;
use Schischkin\DoctrineLombok\Annotations\Getter;
use Schischkin\DoctrineLombok\Annotations\Setter;

class Annotation
{
    private Reader $reader;

    /**
     * Annotation constructor.
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param string $className
     * @throws \ReflectionException
     */
    public function parseClassByClassName(string $className): void
    {
        $class = new \ReflectionClass($className);
        $this->addMethodsByClassAnnotation($class, Getter::class);
        $this->addMethodsByClassAnnotation($class, Setter::class);
        $this->addMethodsByPropertyAnnotation($class, Getter::class);
        $this->addMethodsByPropertyAnnotation($class, Setter::class);
    }

    /**
     * @param object $class
     * @throws \ReflectionException
     */
    public function parseClassByInstance(object $class): void
    {
        $this->parseClassByClassName(get_class($class));
    }

    /**
     * @param \ReflectionClass $class
     * @param string $annotation
     */
    private function addMethodsByClassAnnotation(\ReflectionClass $class, string $annotation): void
    {
        /** @var AccessorInterface|null $accessor */
        $accessor = $this->reader->getClassAnnotation($class, $annotation);
        if (!is_null($accessor)) {
            $accessor->addMagicMethod($class, $class->getProperties());
        }
    }

    /**
     * @param \ReflectionClass $class
     * @param string $annotation
     */
    private function addMethodsByPropertyAnnotation(\ReflectionClass $class, string $annotation): void
    {
        foreach ($class->getProperties() as $property) {
            /** @var AccessorInterface|null $accessor */
            $accessor = $this->reader->getPropertyAnnotation($property, $annotation);
            if (!is_null($accessor)) {
                $accessor->addMagicMethod($class, [$property]);
            }
        }
    }
}