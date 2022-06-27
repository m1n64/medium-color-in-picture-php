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

Basic usage example (one medium color in picture)
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

Range usage example (sorted colors by percentage)
```php
<?php


use Vasqo\Mediumcolor\Image\MediumColor;

require __DIR__ . "/../vendor/autoload.php";

$imageOne = new MediumColor(__DIR__ . "/images/test3.png");

$mediumColorOne = $imageOne->getRGBColorsRange(4);

/* RETURN:
Array
(
    [0] => Array
        (
            [RGB] => Array
                (
                    [red] => 150
                    [green] => 221
                    [blue] => 255
                    [alpha] => 0
                )

            [percent] => 38.81
        )

    [1] => Array
        (
            [RGB] => Array
                (
                    [red] => 23
                    [green] => 27
                    [blue] => 31
                    [alpha] => 0
                )

            [percent] => 24.89
        )

    [2] => Array
        (
            [RGB] => Array
                (
                    [red] => 255
                    [green] => 255
                    [blue] => 255
                    [alpha] => 0
                )

            [percent] => 14.99
        )

    [3] => Array
        (
            [RGB] => Array
                (
                    [red] => 62
                    [green] => 72
                    [blue] => 82
                    [alpha] => 0
                )

            [percent] => 1.64
        )

)
*/

$imageTwo = new MediumColor(__DIR__ . "/images/test1.png");

$mediumColorTwo = $imageTwo->getRGBStringColorsRange(4);

/* RETURN:
Array
(
    [0] => Array
        (
            [RGB] => rgb(1,0,1)
            [percent] => 21.85
        )

    [1] => Array
        (
            [RGB] => rgb(39,45,50)
            [percent] => 1.37
        )

    [2] => Array
        (
            [RGB] => rgb(36,42,46)
            [percent] => 0.84
        )

    [3] => Array
        (
            [RGB] => rgb(37,42,47)
            [percent] => 0.83
        )

)
*/

$imageThree = new MediumColor(__DIR__ . "/images/test4.png");

$mediumColorThree = $imageThree->getHEXColorsRange();
/* RETURN:
Array
(
    [0] => Array
        (
            [percent] => 88.83
            [HEX] => #380C2A
        )

    [1] => Array
        (
            [percent] => 0.33
            [HEX] => #3A0C2A
        )

    [2] => Array
        (
            [percent] => 0.26
            [HEX] => #2B2B2B
        )

    [3] => Array
        (
            [percent] => 0.26
            [HEX] => #2C2C2C
        )

    [4] => Array
        (
            [percent] => 0.21
            [HEX] => #CF7645
        )

    [5] => Array
        (
            [percent] => 0.2
            [HEX] => #380E43
        )

    [6] => Array
        (
            [percent] => 0.18
            [HEX] => #8EC4FA
        )

    [7] => Array
        (
            [percent] => 0.18
            [HEX] => #0A0A0A
        )

)
*/
```

**See test.php and test2.php in "example" folder**

