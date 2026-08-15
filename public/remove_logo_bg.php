<?php
// Remove black background from logo.png and save with transparency
$src = __DIR__ . '/images/logo.png';
$dst = __DIR__ . '/images/logo.png';

// Backup original
copy($src, __DIR__ . '/images/logo_backup.png');

$img = imagecreatefrompng($src);
if (!$img) { die('Could not load logo.png'); }

$w = imagesx($img);
$h = imagesy($img);

// Create new true-color image with alpha support
$out = imagecreatetruecolor($w, $h);
imagealphablending($out, false);
imagesavealpha($out, true);

// Fill with transparent
$transparent = imagecolorallocatealpha($out, 0, 0, 0, 127);
imagefill($out, 0, 0, $transparent);
imagealphablending($out, true);

// Threshold: pixels darker than this value are treated as "black background"
$threshold = 40;

for ($x = 0; $x < $w; $x++) {
    for ($y = 0; $y < $h; $y++) {
        $rgba = imagecolorat($img, $x, $y);
        $r = ($rgba >> 16) & 0xFF;
        $g = ($rgba >>  8) & 0xFF;
        $b =  $rgba        & 0xFF;

        // If pixel is very dark (near black), make transparent
        if ($r < $threshold && $g < $threshold && $b < $threshold) {
            // transparent — skip copying
            continue;
        }

        // Copy pixel as-is
        $color = imagecolorallocatealpha($out, $r, $g, $b, 0);
        imagesetpixel($out, $x, $y, $color);
    }
}

imagealphablending($out, false);
imagesavealpha($out, true);
imagepng($out, $dst);

imagedestroy($img);
imagedestroy($out);

echo "Done! Black background removed from logo.png. Original saved as logo_backup.png";
?>
