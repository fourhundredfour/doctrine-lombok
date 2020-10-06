<?php

use PHPUnit\Framework\TestCase;
use Schischkin\DoctrineLombok\Annotation;
use Schischkin\DoctrineLombok\Annotations\AccessorInterface;
use Schischkin\DoctrineLombok\Annotations\Getter;
use Schischkin\DoctrineLombok\Annotations\Setter;
use Schischkin\DoctrineLombok\ClassLoader;

class ClassLoaderTest extends TestCase
{
    public function testFindAllClassesInSrcFolder(): void
    {
        $classLoader = new ClassLoader();
        $classes = $classLoader->loadClasses(__DIR__ . '/../src');

        $this->assertCount(5, $classes);
        $this->assertContains('\\' . ClassLoader::class, $classes);
        $this->assertContains('\\' . Annotation::class, $classes);
        $this->assertContains('\\' . AccessorInterface::class, $classes);
        $this->assertContains('\\' . Getter::class, $classes);
        $this->assertContains('\\' . Setter::class, $classes);
    }
}
