<img src="black.php" />
<?php
header("Content-Type: image/png");
$image = imagecreate(200,200);
$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
$black = imagecolorallocate($image, 0x00, 0x00, 0x00);
imagefilledrectangle($imaage, 50, 50, 150, 150, $black);
imagepng($image);
?>
