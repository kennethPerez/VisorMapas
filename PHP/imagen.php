<?php
    require './graficos.php';
    header('Content-Type: image/png');
    
    $x = $_REQUEST['x'];
    $y = $_REQUEST['y'];
    $action = $_REQUEST['action'];
    
    $graficos = new graficos();
    
    if($action == 'Caminos') {
        $img = $graficos->crearMapaCaminos($x, $y);
    }
    else if($action == 'Hospitales') {
        $img = $graficos->crearMapaHospitales($x, $y);
    }
    
    imagepng($img);
    imagedestroy($img);
?>