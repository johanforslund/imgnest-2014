<?php
// watermark_wrapper.php

// Path the the requested file
$path = $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'];

// Load the requested image
$image = imagecreatefromstring(file_get_contents($path));

$w = imagesx($image);
$h = imagesy($image);

// Load the watermark image

// Merge watermark upon the original image


$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$text = 'Made by IMGnest.com user';
$font = 'arial.ttf';
$fontsize = $h/24;
$tb = imagettfbbox($fontsize, 60, 'arial.ttf', 'Made by IMGnest.com user');
$x = ($w/2)-($tb[2]/2);
$y = ($h/2)+($tb[4]);

imagettftext($image, $fontsize, 60, $x+2, $y, $white, $font, $text);
imagettftext($image, $fontsize, 60, $x, $y, $black, $font, $text);

// Send the image
header('Content-type: image/jpeg');
imagejpeg($image);
imagedestroy($image);
exit();
?> 
