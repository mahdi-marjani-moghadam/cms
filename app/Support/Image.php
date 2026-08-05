<?php

namespace App\Support;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Image
{
    public static function make($path): ImageWrapper
    {
        $manager = new ImageManager(new Driver());
        return new ImageWrapper($manager->read($path));
    }
}
