<?php
    require './graficos.php';
    header('Content-Type: image/png');
    
    $type = $_REQUEST['type'];    
    $capa = $_REQUEST['capa'];
    $trans = $_REQUEST['trans'];
    $i = $_REQUEST['i'];
    $j = $_REQUEST['j'];
    
    $width = 1024;
    $height = 768;
    $filas = 3;
    $columnas = 3;
    $zoom = 0.0; // 0.0 a 0.95
    $despX = 0.0; //-0.9 a 0.9 Se puede mas pero queda en blanco no se controla eso
    $despY = 0.0; //-0.9 a 0.9 Se puede mas pero queda en blanco no se controla eso
    
    $graficos = new graficos();
    
    if($type == "Polygon")
    {
        $img = $graficos->CreatePolygon($capa, $width, $height, $filas, $columnas, $trans, $zoom, $despX, $despY, $i, $j);
    }
    if($type == "Point")
    {
        $img = $graficos->CreatePoint($capa, $width, $height, $filas, $columnas, $trans, $zoom, $despX, $despY, $i, $j);
    }
    if($type == "Line")
    {
        $img = $graficos->CreateLine($capa, $width, $height, $filas, $columnas, $trans, $zoom, $despX, $despY, $i, $j);
    }       
    
    imagepng($img);
    imagedestroy($img);