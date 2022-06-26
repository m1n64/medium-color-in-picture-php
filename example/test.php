<?php

use Vasqo\Mediumcolor\Image\MediumColor;

require __DIR__."/../vendor/autoload.php";

$imageOne = new MediumColor(__DIR__."/images/test3.png");

$mediumColorOne = $imageOne->getRGBString();
/*
  return rgb(135,166,181)
*/

$imageTwo = new MediumColor(__DIR__."/images/test1.png");

$mediumColorTwo = $imageTwo->getHEX();
/*
  #5F4334
*/

$imageThree = new MediumColor(__DIR__."/images/test4.png");

$mediumColorThree = $imageThree->getRGB();
/*
  Array
  (
    [red] => 64
    [green] => 23
    [blue] => 51
  )
*/