<?php

use yii\imagine\Image;

Image::$driver = ['gd2'];

$imagine = Image::getImagine();
$driverinfo = $imagine->getDriverInfo();

return [
    'class' => 'app\helpers\ImageHelper',
    'webp' => [
        'enabled' => $driverinfo->isFormatSupported('webp'),
        'quality' => 90, // 0 - 100, or 100 for lossless
    ],
    'avif' => [
        'enabled' => $driverinfo->isFormatSupported('avif'),
        'quality' => 90, // 0 - 100, or 100 for lossless
    ],
    'jpg' => [
        'quality' => 90, // 0 - 100
    ],
    'png' => [
        'quality' => 100, // 0 - 100, or 100 for lossless
    ],
];
