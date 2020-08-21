# doctrine-lombok
A Doctrine library to create getter/setter at runtime with annotations.

## Index

## Installation

## Usage
```php
// my_source/Entity/User.php
namespace Schischkin\Entity;

use Schischkin\Annotations\Getter;
use Schischkin\Annotations\Setter;

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
$annotation = new Schischkin\Annotation();
$classLoader = new Schischkin\ClassLoader();

$classNames = $classLoader->loadClasses(__DIR__ . '/my_source');
foreach ($classNames as $className) {
    $annotation->parseClassByClassName($className);
}

$user = new User();
$user->setUsername('fourhundredfour');
echo $user->getUsername(); // Access to the private property
```