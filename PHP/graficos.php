<?php

require '../BD/Conexion.php';

class graficos {
    
    function crearMapaHospitales($x, $y) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $img = imagecreatetruecolor($x, $y);

        $trans = imagecolorallocatealpha($img, 255, 255, 255, 127);
        $red = imagecolorallocatealpha($img, 255, 0, 0, 100);
        $blue = imagecolorallocatealpha($img, 0, 0, 255, 63);
        $green = imagecolorallocatealpha($img, 0, 255, 0, 100);
        
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);
        
        $query = "select ((st_x(st_geometryN(geom,1))-340735.03802508)/551.192698487795) x, 
                        640 - ((st_y(st_geometryN(geom,1))-955392.16848899)/551.192698487795) y 
                 from hospitales";
        
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");        
        
        while ($row = pg_fetch_row($result)) {
            imagefilledellipse($img, $row[0], $row[1], 10, 10, $red);
        }
        
        return ($img);
    }
    
    function crearMapaCaminos($x,$y) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $img = imagecreatetruecolor($x, $y);

        $trans = Imagecolorallocatealpha($img, 255, 255, 255, 127);
        $red = imagecolorallocatealpha($img, 255, 0, 0, 100);
        $blue = imagecolorallocatealpha($img, 0, 0, 255, 63);
        $green = imagecolorallocatealpha($img, 0, 255, 0, 100);
        
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);
        
        $query = "SELECT  (ST_X(ST_GeometryN(c.geom,1))-296480.57186013)/560.63136290052 x,
                            640 - (ST_Y(ST_GeometryN(c.geom,1))-889378.554139937)/560.63136290052 y
                    FROM 	(SELECT gid,
                                    ((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom 
                            FROM caminos) c;";
        
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");
        
        while ($row=pg_fetch_row($result)) {
            imagefilledellipse($img, $row[0], $row[1], 1, 1, $green);
        }
            
        return($img);
    }
}
