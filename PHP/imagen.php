<?php
    require './graficos.php';
    header('Content-Type: image/png');
    
    $x = $_REQUEST['x'];
    $y = $_REQUEST['y'];
    
    $graficos = new graficos();
    $img = $graficos->crearImagen($x, $y);
    
    imagepng($img);
    imagedestroy($img);
?>