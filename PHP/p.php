<?php

require '../BD/Conexion.php';
$conexion = new Conexion();
$conn = $conexion->getConexion();

$largo = 640;
$ancho = 480;

$imagen = imagecreatetruecolor($largo, $ancho);
$transparencia = imagecolorallocatealpha($imagen, 0, 0, 0, 127);       
imagefilltoborder($imagen, 50, 50, $transparencia, $transparencia);
imagesavealpha($imagen, true);
$orange = imagecolorallocatealpha($imagen, 242, 117, 7, 0);

imageline($imagen , 0, 0 , 640 , 480 , $orange);

header('Content-type: image/png');
imagepng($imagen);
imagedestroy($imagen);