<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Intervention\Image\Interfaces\ImageInterface;

class ImageResizeService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function resize(
        string $fullPath,
        string $type,
        string $outputDir,
        string $fileName,
        string $extension,
        bool $convertToJpeg = false,
        int $quality = 80
    ): array {

        $image = $this->manager->read($fullPath);

        $sizes = $this->getSizes($type);

        $results = [];

        foreach ($sizes as $name => $width) {

            $ext = $this->resolveExtension($extension, $convertToJpeg);

            $outputPath = $outputDir . $fileName . "-{$name}.{$ext}";

            $processed = $image->scale(width: (int) $width);

            $this->saveImage($processed, public_path($outputPath), $ext, $quality);

            $results[$name] = $outputPath;
        }

        // ORIGINAL (safe)
        $originalExt = $this->resolveExtension($extension, $convertToJpeg);
        $originalPath = $outputDir . $fileName . ".{$originalExt}";

        $this->saveImage($image, public_path($originalPath), $originalExt, $quality);

        $results['original'] = $originalPath;

        return $results;
    }

    /**
     * CENTRAL SIZE CONFIG
     */
    private function getSizes(string $type): array
    {
        $type = Str::upper($type);

        $sizes = [
            'small'  => (int) env("{$type}_SMALL_W", 300),
            'medium' => (int) env("{$type}_MEDIUM_W", 600),
            'large'  => (int) env("{$type}_LARGE_W", 1200),
        ];

        if (env("{$type}_XLARGE_W")) {
            $sizes['xlarge'] = (int) env("{$type}_XLARGE_W");
        }

        return $sizes;
    }

    /**
     * Smart extension resolver
     */
    private function resolveExtension(string $ext, bool $convertToJpeg): string
    {
        $ext = strtolower($ext);

        if ($convertToJpeg) {
            return 'jpg';
        }

        return \in_array($ext, ['png', 'webp', 'gif']) ? $ext : 'jpg';
    }

    /**
     * Safe save handler
     */
    private function saveImage(ImageInterface $image, string $path, string $ext, int $quality): void
    {
        if ($ext === 'png') {
            $image->save($path);
            return;
        }

        $image->toJpeg($quality)->save($path);
    }
}
