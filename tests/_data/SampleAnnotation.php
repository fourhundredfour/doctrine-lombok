<?php

namespace Schischkin\DoctrineLombok\Tests\_data;

use Schischkin\DoctrineLombok\Annotations\Getter;
use Schischkin\DoctrineLombok\Annotations\Setter;

/**
 * @Getter
 */
class SampleAnnotation
{
    /** @Setter */
    private string $name;
    public string $email;
}