<?php

namespace Vasqo\Mediumcolor\Image;

use Vasqo\Mediumcolor\ColorConverter\Converter;

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

    /**
     * @return string
     */
    public function getRGBString(): string
    {
        $rgbMediumColor = $this->getMediumColor();

        return Converter::rgbToString(
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

        return Converter::rgbToHEX(
            $rgbMediumColor["red"],
            $rgbMediumColor["green"],
            $rgbMediumColor["blue"]
        );
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getRGBColorsRange(int $limit = 8): array
    {
        $colors = $this->getMediumColors();

        return array_slice($colors, 0, $limit);
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getRGBStringColorsRange(int $limit = 8) : array
    {
        $colors = $this->getMediumColors();

        foreach ($colors as $key=>$color) {
            $colors[$key]["RGB"] = Converter::rgbToString(
                $color["RGB"]["red"],
                $color["RGB"]["green"],
                $color["RGB"]["blue"]
            );
        }

        return array_slice($colors, 0, $limit);
    }

    public function getHEXColorsRange(int $limit = 8) : array
    {
        $colors = $this->getMediumColors();

        foreach ($colors as $key=>$color) {
            $colors[$key]["HEX"] = Converter::rgbToHEX(
                $color["RGB"]["red"],
                $color["RGB"]["green"],
                $color["RGB"]["blue"]
            );

            unset($colors[$key]["RGB"]);
        }

        return array_slice($colors, 0, $limit);
    }

    /**
     * @return array
     */
    private function getMediumColors(): array
    {
        $imageColors = $this->getColors();

        $colorsList = [];

        $maxColors = count($imageColors);

        foreach ($imageColors as $key => $color) {
            $index = Converter::rgbToHEX(
                $color["red"],
                $color["green"],
                $color["blue"],
            );

            if (isset($colorsList[$index])) {
                $colorsList[$index]["index"]++;
            } else {
                $colorsList[$index] = [
                    'key' => $key,
                    'index' => 1
                ];
            }
        }

        usort($colorsList, function ($a, $b) {
            return $a["index"] < $b["index"];
        });

        $finalColorsRange = [];
        foreach ($colorsList as $color) {
            $percent = round($color["index"] / $maxColors * 100, 2);
            $finalColorsRange[] = [
                'RGB'=>$imageColors[$color["key"]],
                'percent'=>$percent
            ];
        }

        return $finalColorsRange;
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