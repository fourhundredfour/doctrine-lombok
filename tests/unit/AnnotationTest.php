<?php

namespace Schischkin\DoctrineLombok\Tests\unit;

use Doctrine\Common\Annotations\Reader;
use PHPUnit\Framework\MockObject\MockObject;
use Schischkin\DoctrineLombok\Annotation;
use PHPUnit\Framework\TestCase;
use Schischkin\DoctrineLombok\Tests\_data\SampleAnnotation;

class AnnotationTest extends TestCase
{
    private Annotation $instance;
    /** @var Reader|MockObject */
    private $readerMock;

    public function setUp(): void
    {
        $this->readerMock = $this->createMock(Reader::class);
        $this->instance = new Annotation($this->readerMock);
    }

    public function testParseClassByClassNameMethodShouldAddMagicMethods()
    {
        $this->readerMock->method('')
        $this->instance->parseClassByClassName(SampleAnnotation::class);
        $testInstance = new SampleAnnotation();
        $testInstance->email = 'daniel@schischkin.info';
        $testInstance->setName('Daniel');
        $this->assertEquals('daniel@schischkin.info', $testInstance->getEmail());
        $this->assertEquals('Daniel', $testInstance->getName());
    }
}
