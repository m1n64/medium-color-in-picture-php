## Medium color of a picture (PHP Library)

Get medium color in picture

### Install

1. Require library via composer:
```bash
composer require vasqo/mediumcolor
```

2. After require Composer's autoloader:
```php
require "vendor/autoload.php";
```

### Usage example

```php
<?php

use Vasqo\Mediumcolor\Image\MediumColor;

require "vendor/autoload.php";

$imageOne = new MediumColor("./example/images/test3.png");

$mediumColorOne = $imageOne->getRGBString();
/* RETURN: 
  return rgb(135,166,181)
*/

$imageTwo = new MediumColor("./example/images/test1.png");

$mediumColorTwo = $imageTwo->getHEX();
/* RETURN: 
  #5F4334
*/

$imageThree = new MediumColor("./example/images/test4.png");

$mediumColorThree = $imageThree->getRGB();
/* RETURN:
  Array
  (
    [red] => 64
    [green] => 23
    [blue] => 51
  )
*/
```