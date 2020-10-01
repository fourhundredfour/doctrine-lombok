# doctrine-lombok
A Doctrine library to create getter/setter at runtime with annotations.

## Index
* [Requirements](#requirements)
* [Usage](#usage)

## Requirements
* Doctrine
* >=PHP 7.4

## Usage
```php
// my_source/Entity/User.php
<?php

namespace Schischkin\DoctrineLombok\Entity;

use Schischkin\DoctrineLombok\Annotations\Getter;
use Schischkin\DoctrineLombok\Annotations\Setter;

/** @Getter */
class User {
    /** @Setter */
    private $username;
    private $password;
}

```


```php
// app.php
...
$annotation = new Schischkin\DoctrineLombok\Annotation($reader);
$classLoader = new Schischkin\DoctrineLombok\ClassLoader();

$classNames = $classLoader->loadClasses(__DIR__ . '/my_source');
foreach ($classNames as $className) {
    $annotation->parseClassByClassName($className);
}

$user = new User();
$user->setUsername('fourhundredfour');
echo $user->getUsername(); // Access to the private property
```