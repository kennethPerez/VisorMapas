<?php
    require './graficos.php';
    header('Content-Type: image/png');
    
    $type = $_REQUEST['type'];    
    $capa = $_REQUEST['capa'];
    $trans = $_REQUEST['trans'];
    $i = $_REQUEST['i'];
    $j = $_REQUEST['j'];
    
    $graficos = new graficos();
    
    if($type == "Polygon")
    {
        $img = $graficos->CreatePolygon($capa, 1024, 768, 3, 3, $trans, $i, $j);
    }
    if($type == "Point")
    {
        $img = $graficos->CreatePoint($capa, 1024, 768, 3, 3, $trans, $i, $j);
    }
    if($type == "Line")
    {
        $img = $graficos->CreateLine($capa, 1024, 768, 3, 3, $trans, $i, $j);
    }       
    
    imagepng($img);
    imagedestroy($img);