<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageOptimizerService
{
    /**
     * Compress and optimize an uploaded image file using GD.
     * Resizes if dimensions exceed $maxWidth / $maxHeight while maintaining aspect ratio.
     * Compresses heavy uploads to optimized JPEG format (approx 80-85% quality).
     *
     * @param UploadedFile $file
     * @param string $subDirectory Subfolder inside storage/app/public e.g. 'products' or 'custom_designs'
     * @param int $maxWidth Max width constraint
     * @param int $maxHeight Max height constraint
     * @param int $quality Compression quality (1-100)
     * @return string Returns web accessible relative path e.g. '/storage/products/1700000_abc.jpg'
     */
    public static function compressAndStore(UploadedFile $file, string $subDirectory = 'products', int $maxWidth = 1200, int $maxHeight = 1600, int $quality = 82): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = $file->getMimeType();
        
        $destinationDir = storage_path('app/public/' . trim($subDirectory, '/'));
        if (!file_exists($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        $filename = time() . '_' . uniqid() . '.jpg';
        $targetPath = $destinationDir . '/' . $filename;

        // Try creating image resource from GD
        $srcImage = null;
        if (in_array($extension, ['jpg', 'jpeg']) || str_contains($mime, 'jpeg')) {
            $srcImage = @imagecreatefromjpeg($file->getRealPath());
        } elseif ($extension === 'png' || str_contains($mime, 'png')) {
            $srcImage = @imagecreatefrompng($file->getRealPath());
        } elseif ($extension === 'webp' || str_contains($mime, 'webp')) {
            $srcImage = @imagecreatefromwebp($file->getRealPath());
        } elseif ($extension === 'bmp' || str_contains($mime, 'bmp')) {
            $srcImage = @imagecreatefrombmp($file->getRealPath());
        }

        // Fallback: If GD fails to parse or image format is unsupported, fallback to standard Laravel store()
        if (!$srcImage) {
            $path = $file->store(trim($subDirectory, '/'), 'public');
            return '/storage/' . $path;
        }

        // Get original dimensions
        $origWidth = imagesx($srcImage);
        $origHeight = imagesy($srcImage);

        // Calculate aspect ratio scaling
        $newWidth = $origWidth;
        $newHeight = $origHeight;

        if ($origWidth > $maxWidth || $origHeight > $maxHeight) {
            $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);
            $newWidth = (int) round($origWidth * $ratio);
            $newHeight = (int) round($origHeight * $ratio);
        }

        // Create canvas with smooth resampling
        $canvas = imagecreatetruecolor($newWidth, $newHeight);

        // Fill background with white (prevents black background when converting PNG with transparency)
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefill($canvas, 0, 0, $white);

        // Copy and resample image smoothly
        imagecopyresampled(
            $canvas,
            $srcImage,
            0, 0, 0, 0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        // Output compressed JPEG with specified quality (default 82%)
        imagejpeg($canvas, $targetPath, $quality);

        // Free memory
        imagedestroy($srcImage);
        imagedestroy($canvas);

        return '/storage/' . trim($subDirectory, '/') . '/' . $filename;
    }
    /**
     * Compress an existing image in place.
     */
    public static function compressExistingImage(string $filePath, int $maxWidth = 1200, int $maxHeight = 1600, int $quality = 82): bool
    {
        if (!file_exists($filePath)) {
            return false;
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $mime = mime_content_type($filePath);

        $srcImage = null;
        if (in_array($extension, ['jpg', 'jpeg']) || str_contains($mime, 'jpeg')) {
            $srcImage = @imagecreatefromjpeg($filePath);
        } elseif ($extension === 'png' || str_contains($mime, 'png')) {
            $srcImage = @imagecreatefrompng($filePath);
        } elseif ($extension === 'webp' || str_contains($mime, 'webp')) {
            $srcImage = @imagecreatefromwebp($filePath);
        } elseif ($extension === 'bmp' || str_contains($mime, 'bmp')) {
            $srcImage = @imagecreatefrombmp($filePath);
        }

        if (!$srcImage) {
            return false;
        }

        $origWidth = imagesx($srcImage);
        $origHeight = imagesy($srcImage);

        $newWidth = $origWidth;
        $newHeight = $origHeight;

        if ($origWidth > $maxWidth || $origHeight > $maxHeight) {
            $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);
            $newWidth = (int) round($origWidth * $ratio);
            $newHeight = (int) round($origHeight * $ratio);
        }

        $canvas = imagecreatetruecolor($newWidth, $newHeight);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefill($canvas, 0, 0, $white);

        imagecopyresampled($canvas, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

        // Save back to the same file
        $success = imagejpeg($canvas, $filePath, $quality);

        imagedestroy($srcImage);
        imagedestroy($canvas);

        return $success;
    }
}
