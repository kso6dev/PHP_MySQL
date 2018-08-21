<?php 
header("Content-type: image/png");

$pic = imagecreate(400,200);
//$pic = imagecreatetruecolor(400,200);

$orange = imagecolorallocate($pic, 255, 128, 0); //Attention la première fois que la fonction est appelée ça définit la couleur de fond de l'image
$blue = imagecolorallocate($pic, 0, 0, 255);
$lightblue = imagecolorallocate($pic, 156, 227, 254);
$white = imagecolorallocate($pic, 255, 255, 255);
$black = imagecolorallocate($pic, 0, 0, 0);

imagestring($pic, 2, 40, 23, 'image créée en php',$white); //ajout de texte

ImageSetPixel($pic, 100, 100, $black);
ImageSetPixel($pic, 101, 101, $black);
ImageSetPixel($pic, 102, 102, $black);
ImageSetPixel($pic, 103, 102, $black);
ImageSetPixel($pic, 104, 101, $black);
ImageSetPixel($pic, 105, 100, $black);

ImageLine($pic, 170, 100, 165, 110, $black);
ImageLine($pic, 165, 100, 170, 110, $black);

ImageLine($pic, 120, 120, 150, 120, $black);

ImageEllipse($pic, 300, 100, 50, 50, $black);

ImageRectangle($pic, 300, 40, 370, 100, $black);


ImagePolygon($pic, array(10, 150, 60, 180, 90, 150), 3, $black);
ImagePolygon($pic, array(110, 160, 160, 190, 180, 150, 120, 130, 110, 110), 5, $black);

//imagecolortransparent($pic, $orange);

imagepng($pic);

?>