<?php 
header("Content-type: image/png");

$pngpic = imagecreatefrompng("../images/dessin.png");

imagepng($pngpic);

?>