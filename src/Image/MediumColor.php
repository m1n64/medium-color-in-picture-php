<?php

namespace Vasqo\Mediumcolor\Image;


final class MediumColor
{
    /**
     * @var false|\GdImage|resource
     */
    protected $imageResource;

    /**
     * MediumColor constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->imageResource = imagecreatefromstring(
            file_get_contents($fileName)
        );
    }

    public function __destruct()
    {
        imagedestroy($this->imageResource);
    }

    /**
     * @return array
     */
    public function getRGB(): array
    {
        return $this->getMediumColor();
    }

    public function getRGBString()
    {
        $rgbMediumColor = $this->getMediumColor();

        return sprintf(
            "rgb(%u,%u,%u)",
            $rgbMediumColor["red"],
            $rgbMediumColor["green"],
            $rgbMediumColor["blue"]
        );
    }

    /**
     * @return string
     */
    public function getHEX(): string
    {
        $rgbMediumColor = $this->getMediumColor();

        return sprintf(
            "#%02X%02X%02X",
            $rgbMediumColor["red"],
            $rgbMediumColor["green"],
            $rgbMediumColor["blue"]
        );
    }

    /**
     * @return array
     */
    private function getMediumColor(): array
    {
        $imageColors = $this->getColors();

        $colorRed = 0;
        $colorGreen = 0;
        $colorBlue = 0;

        $maxColors = count($imageColors);

        foreach ($imageColors as $color) {
            $colorRed += $color["red"];
            $colorGreen += $color["green"];
            $colorBlue += $color["blue"];
        }

        return [
            'red' => round($colorRed / $maxColors),
            'green' => round($colorGreen / $maxColors),
            'blue' => round($colorBlue / $maxColors),
        ];
    }

    /**
     * @return array
     */
    private function getColors(): array
    {
        $maxX = imagesx($this->imageResource);
        $maxY = imagesy($this->imageResource);

        $imageColors = [];

        for ($x = 0; $x < $maxX; $x++) {
            for ($y = 0; $y < $maxY; $y++) {
                $imageColors[] = $this->getColorByPix($x, $y);
            }
        }

        return $imageColors;
    }

    /**
     * @param int $x
     * @param int $y
     * @return array|false
     */
    private function getColorByPix(int $x, int $y): array
    {
        $colorIndex = imagecolorat($this->imageResource, $x, $y);

        return imagecolorsforindex($this->imageResource, $colorIndex);
    }
}