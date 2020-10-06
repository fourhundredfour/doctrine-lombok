# doctrine-lombok
A Doctrine library to create getter/setter at runtime with annotations.

## Index
* [Requirements](#requirements)
* [Usage](#usage)
* [Badges](#badges)

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

## Badges
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=fourhundredfour_doctrine-lombok&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=fourhundredfour_doctrine-lombok)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=fourhundredfour_doctrine-lombok&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=fourhundredfour_doctrine-lombok)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=fourhundredfour_doctrine-lombok&metric=security_rating)](https://sonarcloud.io/dashboard?id=fourhundredfour_doctrine-lombok)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=fourhundredfour_doctrine-lombok&metric=alert_status)](https://sonarcloud.io/dashboard?id=fourhundredfour_doctrine-lombok)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=fourhundredfour_doctrine-lombok&metric=sqale_index)](https://sonarcloud.io/dashboard?id=fourhundredfour_doctrine-lombok)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=fourhundredfour_doctrine-lombok&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=fourhundredfour_doctrine-lombok)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=fourhundredfour_doctrine-lombok&metric=bugs)](https://sonarcloud.io/dashboard?id=fourhundredfour_doctrine-lombok)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=fourhundredfour_doctrine-lombok&metric=code_smells)](https://sonarcloud.io/dashboard?id=fourhundredfour_doctrine-lombok)
