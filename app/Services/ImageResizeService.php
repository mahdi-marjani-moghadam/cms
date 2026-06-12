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
        string $fullPath,  //  public_path('/upload/images/2026/5/T403.5052-crop.jpg')
        string $type,
        string $outputDir, //  /upload/images/{$year}/{$month}/
        string $fileName,
        string $extension,
        int $quality = 80,
        ?string $watermark = null
    ): array {

        $originalImage = $this->manager->read($fullPath);

        $sizes = $this->getSizes($type);

        $results = [];

        foreach ($sizes as $size_name => $width) {

            $image = clone $originalImage;

            $ext = $this->resolveExtension($extension);

            $outputPath = "{$outputDir}{$fileName}-{$size_name}.{$ext}";

            $processed = $image->scale(width: (int) $width);

            $this->saveImage($processed, public_path($outputPath), $ext, $quality);

            // ✅ watermark applied AFTER save (safe & consistent)
            if ($watermark) {
                $this->applyWatermark(
                    image: $processed,
                    path: public_path($outputPath),
                    type: $type,
                    size: $size_name,
                    text: $watermark,
                );
            }

            $results[$size_name] = $outputPath;
        }


        // ORIGINAL (safe)
        $originalExt = $this->resolveExtension($extension);
        $originalPath = "{$outputDir}{$fileName}.{$originalExt}";

        $this->saveImage($originalImage, public_path($originalPath), $originalExt, 100);

        $results['crop'] = $originalPath;

        return $results;
    }

    /**
     * CENTRAL SIZE CONFIG
     */
    private function getSizes(string $type): array
    {
        $type = Str::upper($type);

        $sizes = [
            'small' => (int) env("{$type}_SMALL_W", 300),
            'medium' => (int) env("{$type}_MEDIUM_W", 600),
            'large' => (int) env("{$type}_LARGE_W", 1200),
        ];

        if (env("{$type}_XLARGE_W")) {
            $sizes['xlarge'] = (int) env("{$type}_XLARGE_W");
        }

        return $sizes;
    }

    /**
     * Smart extension resolver
     */
    private function resolveExtension(string $ext): string
    {
        return strtolower($ext);
    }

    /**
     * Safe save handler
     */
    private function saveImage(ImageInterface $image, string $path, string $ext, int $quality): void
    {
        $ext = strtolower($ext);

        match ($ext) {
            'jpg', 'jpeg' => $image->toJpeg($quality)->save($path),
            'png' => $image->save($path), // keep PNG native
            'webp' => method_exists($image, 'toWebp')
            ? $image->toWebp($quality)->save($path)
            : $image->save($path),
            default => $image->save($path),
        };
    }

    private function applyWatermark(
        ImageInterface $image,
        string $path,
        string $type,
        string $size,
        string $text
    ): void {


        $sizeKey = Str::upper($size);

        $w = env(Str::upper($type) . '_' . $sizeKey . '_W', 800);
        $h = env(Str::upper($type) . '_' . $sizeKey . '_H', 600);

        $image->text($text, $w / 2, $h / 2, function ($font) use ($w) {
            $font->file(public_path('/adminAssets/fonts/IRANSans/ttf/IRANSansWeb.ttf'));
            $font->size($w / 10);
            $font->color('rgba(0,0,0,0.2)');
            $font->align('center');
            $font->valign('bottom');
            $font->angle(45);
        });

        $image->save($path);
    }
}
