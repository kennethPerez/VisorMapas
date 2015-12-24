<?php

require '../BD/Conexion.php';

class graficos {
    
    function crearMapaHospitales($x, $y) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $img = imagecreatetruecolor($x, $y);

        $trans = Imagecolorallocatealpha($img, 255, 255, 255, 127);
        $skyBlue = imagecolorallocatealpha($img, 30, 115, 190, 0);
        $yellow = imagecolorallocatealpha($img, 238, 231, 41, 0);
        $red = imagecolorallocatealpha($img, 229, 0, 0, 0);
        $blue = imagecolorallocatealpha($img, 2, 24, 89, 0);
        $orange = imagecolorallocatealpha($img, 242, 117, 7, 0);
        $green = imagecolorallocatealpha($img, 0, 178, 48, 0);
        $purple = imagecolorallocatealpha($img, 191, 48, 153, 0);
        
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);
        
        $query = "SELECT ((st_x(st_geometryN(geom,1))-296480.57186013)/560.63136290052) x, 
                         640 - ((st_y(st_geometryN(geom,1))-889378.554139937)/560.63136290052) y 
                 FROM hospitales";
        
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");        
        
        while ($row = pg_fetch_row($result)) {
            imagefilledellipse($img, $row[0], $row[1], 6, 6, $purple);
        }
        
        return ($img);
    }
    
    function crearMapaCaminos($x,$y) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $img = imagecreatetruecolor($x, $y);

        $trans = Imagecolorallocatealpha($img, 255, 255, 255, 127);
        $skyBlue = imagecolorallocatealpha($img, 30, 115, 190, 0);
        $yellow = imagecolorallocatealpha($img, 238, 231, 41, 0);
        $red = imagecolorallocatealpha($img, 229, 0, 0, 0);
        $blue = imagecolorallocatealpha($img, 2, 24, 89, 0);
        $orange = imagecolorallocatealpha($img, 242, 117, 7, 0);
        $green = imagecolorallocatealpha($img, 0, 178, 48, 0);
        $purple = imagecolorallocatealpha($img, 191, 48, 153, 0);
        
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);
        
        $query = "SELECT (ST_X(ST_GeometryN(c.geom,1))-296480.57186013)/560.63136290052 x,
                         640 - (ST_Y(ST_GeometryN(c.geom,1))-889378.554139937)/560.63136290052 y
                  FROM 	 (SELECT ((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom 
                         FROM caminos) c;";
        
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");
        
        while ($row=pg_fetch_row($result)) {
            imagefilledellipse($img, $row[0], $row[1], 1, 1, $green);
        }
            
        return($img);
    }
    
    function crearMapaRios($x,$y) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $img = imagecreatetruecolor($x, $y);

        $trans = Imagecolorallocatealpha($img, 255, 255, 255, 127);
        $skyBlue = imagecolorallocatealpha($img, 30, 115, 190, 0);
        $yellow = imagecolorallocatealpha($img, 238, 231, 41, 0);
        $red = imagecolorallocatealpha($img, 229, 0, 0, 0);
        $blue = imagecolorallocatealpha($img, 2, 24, 89, 0);
        $orange = imagecolorallocatealpha($img, 242, 117, 7, 0);
        $green = imagecolorallocatealpha($img, 0, 178, 48, 0);
        $purple = imagecolorallocatealpha($img, 191, 48, 153, 0);
        
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);
        
        $query = "SELECT (ST_X(ST_GeometryN(r.geom,1))-296480.57186013)/560.63136290052 x,
                         640 - (ST_Y(ST_GeometryN(r.geom,1))-889378.554139937)/560.63136290052 y
                  FROM 	 (SELECT ((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom 
                         FROM rios) r;";
        
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");
        
        while ($row=pg_fetch_row($result)) {
            imagefilledellipse($img, $row[0], $row[1], 1, 1, $skyBlue);
        }
            
        return($img);
    }
    
    function crearMapaEscuelas($x,$y) {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $img = imagecreatetruecolor($x, $y);

        $trans = Imagecolorallocatealpha($img, 255, 255, 255, 127);
        $skyBlue = imagecolorallocatealpha($img, 30, 115, 190, 0);
        $yellow = imagecolorallocatealpha($img, 238, 231, 41, 0);
        $red = imagecolorallocatealpha($img, 229, 0, 0, 0);
        $blue = imagecolorallocatealpha($img, 2, 24, 89, 0);
        $orange = imagecolorallocatealpha($img, 242, 117, 7, 0);
        $green = imagecolorallocatealpha($img, 0, 178, 48, 0);
        $purple = imagecolorallocatealpha($img, 191, 48, 153, 0);
        
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);
        
        $query = "SELECT (ST_X(ST_GeometryN(geom,1))-296480.57186013)/560.63136290052 x,
                         640 - (ST_Y(ST_GeometryN(geom,1))-889378.554139937)/560.63136290052 y
                  FROM escuelaspu;";
        
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");
        
        while ($row=pg_fetch_row($result)) {
            imagefilledellipse($img, $row[0], $row[1], 6, 6, $orange);
        }
            
        return($img);
    }
}
