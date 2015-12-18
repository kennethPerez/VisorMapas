<?php

require '../BD/Conexion.php';


class graficos {
    
    function crearImagen($x, $y)
    {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $img = imagecreatetruecolor($x, $y);

        $trans = imagecolorallocatealpha($img, 255, 255, 255, 127);
        $red = imagecolorallocatealpha($img, 255, 0, 0, 100);
        $blue = imagecolorallocatealpha($img, 0, 0, 255, 63);
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);
        
        
        $query = "select ((st_x(st_geometryN(geom,1))-340735.03802508)/551.192698487795) x, 
                        ((st_y(st_geometryN(geom,1))-955392.16848899)/551.192698487795) y 
                 from hospitales";
        
                
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");        
        
        while ($row = pg_fetch_row($result))
        {
            imagefilledellipse($img, $row[0], $row[1], 5, 5, $red);
        }
        
        return ($img);
    }
}
