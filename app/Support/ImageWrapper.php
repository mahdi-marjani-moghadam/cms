<?php

namespace App\Support;

use Intervention\Image\Image;

class ImageWrapper
{
    private Image $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function resize($width, $height = null, $callback = null): self
    {
        if ($callback) {
            $constraint = new class {
                public function aspectRatio() {}
                public function upsize() {}
            };
            $callback($constraint);
        }

        $this->image->scaleDown(width: (int) $width);

        return $this;
    }

    public function text($string, $x, $y, $callback = null): self
    {
        $options = [
            'position' => ['x' => (int) $x, 'y' => (int) $y],
            'font' => [],
        ];

        if ($callback) {
            $fontConfig = new class {
                public array $config = [];
                public function file($path) { $this->config['file'] = $path; }
                public function size($size) { $this->config['size'] = (int) $size; }
                public function color($color) { $this->config['color'] = $color; }
                public function align($align) { $this->config['align'] = $align; }
                public function valign($valign) { $this->config['valign'] = $valign; }
                public function angle($angle) { $this->config['angle'] = (int) $angle; }
            };
            $callback($fontConfig);
            $options['font'] = $fontConfig->config;
        }

        $this->image->text($string, $options['position'], $options['font']);

        return $this;
    }

    public function save($path, $quality = 90, $format = null): self
    {
        $this->image->save($path, quality: (int) $quality);

        return $this;
    }

    public function getCore(): Image
    {
        return $this->image;
    }
}
