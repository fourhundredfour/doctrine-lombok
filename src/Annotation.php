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
        $this->setMethodsByClassAnnotation($class, Getter::class);
        $this->setMethodsByClassAnnotation($class, Setter::class);
        $this->setMethodsByPropertyAnnotation($class, Getter::class);
        $this->setMethodsByPropertyAnnotation($class, Setter::class);
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
    private function setMethodsByClassAnnotation(\ReflectionClass $class, string $annotation): void
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
    private function setMethodsByPropertyAnnotation(\ReflectionClass $class, string $annotation): void
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