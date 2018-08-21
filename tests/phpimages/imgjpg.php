<?php 
header("Content-type: image/jpeg");

$jpgpic = imagecreatefromjpeg("../images/1.jpg");

imagejpeg($jpgpic);

?>