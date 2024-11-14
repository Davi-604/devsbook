<?php

namespace src\utils;

class ImageUtil
{
    public static function formatImage($file, int $width, int $height, string $destFolder): string
    {
        list($originalWidth, $orginalHeight) = getimagesize($file['tmp_name']);

        $ratio = $originalWidth / $orginalHeight;

        $newWidth = $width;
        $newHeight = $newWidth / $ratio;
        if ($newHeight < $height) {
            $newHeight = $height;
            $newWidth = $newHeight * $ratio;
        }

        $x = $width - $newWidth;
        $x = ($x < 0 ? $x / 2 : $x);

        $y = $height - $newHeight;
        $y = ($y < 0 ? $y / 2 : $y);

        $finalImage = imagecreatetruecolor($width, $height);
        switch ($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
        }

        imagecopyresampled(
            $finalImage,
            $image,
            $x,
            $y,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $orginalHeight
        );

        $fileName = md5(time() . rand(0, 9999)) . '.jpg';

        imagejpeg($finalImage, "$destFolder/$fileName");

        return $fileName;
    }
}
