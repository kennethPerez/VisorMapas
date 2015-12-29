<?php

require '../BD/Conexion.php';


class graficos {
      
    
    function CreatePoint($capa, $largo, $ancho, $filas, $columnas, $trans, $i, $j)
    {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $nLargo = $largo/$filas;
        $nAncho = $ancho/$columnas;
        
        $factorLargo = $nLargo*$j;
        $factorAncho = $nAncho*$i;
        
        $Xde = $factorLargo;
        $Xa = $factorLargo + $nLargo;
        
        $Yde = $factorAncho;
        $Ya = $factorAncho + $nAncho;
                
        $imagen = imagecreatetruecolor($nLargo, $nAncho);
        $transparencia = imagecolorallocatealpha($imagen, 0, 0, 0, 127);       
        imagefilltoborder($imagen, 50, 50, $transparencia, $transparencia);
        imagesavealpha($imagen, true);
        
        
        $query = "";
        if($capa == "h")
        {
            $blue = imagecolorallocatealpha($imagen, 0, 0, 255, $trans);
            $query = "select ((st_x(st_geometryN(geom,1))-o.xinicial)/o.factor) as x, ($ancho-((st_y(st_geometryN(geom,1))-o.yinicial)/o.factor)) as y 
                      from hospitales ,
                           (select min(st_xmin(geom)) xinicial, (max(st_xmax(geom))-min(st_xmin(geom)))/$ancho factor,min(st_ymin(geom)) yinicial from distritos) as o
                       where (((st_x(st_geometryN(geom,1))-o.xinicial)/o.factor) between $Xde and $Xa) and (($ancho-((st_y(st_geometryN(geom,1))-o.yinicial)/o.factor)) between $Yde and $Ya)";
            
            $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");        
        
            while ($row = pg_fetch_row($result))
            {
                imagefilledellipse($imagen, ($row[0]-$factorLargo), ($row[1]-$factorAncho), 6, 6, $blue);
            }
        }
        else if($capa == "e")
        {
           $red = imagecolorallocatealpha($imagen, 255, 0, 0, $trans);
           $query = "select ((st_x(st_geometryN(geom,1))-o.xinicial)/o.factor) as x, ($ancho-((st_y(st_geometryN(geom,1))-o.yinicial)/o.factor)) as y 
                      from escuelas_publicas ,
                           (select min(st_xmin(geom)) xinicial, (max(st_xmax(geom))-min(st_xmin(geom)))/$ancho factor,min(st_ymin(geom)) yinicial from distritos) as o
                      where (((st_x(st_geometryN(geom,1))-o.xinicial)/o.factor) between $Xde and $Xa) and (($ancho-((st_y(st_geometryN(geom,1))-o.yinicial)/o.factor)) between $Yde and $Ya)";
            
            $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");        
        
            while ($row = pg_fetch_row($result))
            {
                imagefilledellipse($imagen, ($row[0]-$factorLargo), ($row[1]-$factorAncho), 6, 6, $red);
            } 
        }
        
        return ($imagen);
    }
    
    function CreatePolygon($capa, $largo, $ancho, $filas, $columnas, $trans, $i, $j)
    {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $nLargo = $largo/$filas;
        $nAncho = $ancho/$columnas;
        
        $factorLargo = $nLargo*$j;
        $factorAncho = $nAncho*$i;
        
        $Xde = $factorLargo;
        $Xa = $factorLargo + $nLargo;
        
        $Yde = $factorAncho;
        $Ya = $factorAncho + $nAncho;
        
        
        $imagen = imagecreatetruecolor($nLargo, $nAncho);
        $transparencia = imagecolorallocatealpha($imagen, 0, 0, 0, 127);       
        imagefilltoborder($imagen, 50, 50, $transparencia, $transparencia);
        imagesavealpha($imagen, true);
        
        $negro = imagecolorallocatealpha($imagen, 0, 0, 0, 0);
        
        $query = "";
        if($capa == "d")
        {
            $verde = imagecolorallocatealpha($imagen, 0, 255, 0, $trans);
            $query = "SELECT gid, count(((d.x - c.xinicial)/c.factor)) as npuntos, string_agg((cast( ((d.x - c.xinicial)/c.factor)-$factorLargo as varchar)||','||cast( ($ancho-((d.y - c.yinicial)/c.factor))-$factorAncho as varchar)),',') as puntos
                          FROM 
                           (SELECT gid, st_x((ST_DumpPoints(geom)).geom) x, st_y((ST_DumpPoints(geom)).geom) y FROM distritos) d,
                           (select min(st_xmin(geom)) xinicial, (max(st_xmax(geom))-min(st_xmin(geom)))/$ancho factor,min(st_ymin(geom)) yinicial from distritos) c
                          where ( ((d.x - c.xinicial)/c.factor) between $Xde and $Xa) and ( ($ancho-((d.y - c.yinicial)/c.factor)) between $Yde and $Ya)
                          group by gid";

            $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");
            while ($row = pg_fetch_row($result))
            {    
                $valores = explode(",", $row[2]);
                imagefilledpolygon($imagen, $valores, $row[1], $verde);
                //imagepolygon($imagen, $valores, $row[1], $negro);
            }
        
        }        
        
        return ($imagen);
    }
    
    function CreateLine($capa, $largo, $ancho, $filas, $columnas, $trans, $i, $j)
    {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        
        $nLargo = $largo/$filas;
        $nAncho = $ancho/$columnas;
        
        $factorLargo = $nLargo*$j;
        $factorAncho = $nAncho*$i;
        
        $Xde = $factorLargo;
        $Xa = $factorLargo + $nLargo;
        
        $Yde = $factorAncho;
        $Ya = $factorAncho + $nAncho;
        
        
        $imagen = imagecreatetruecolor($nLargo, $nAncho);
        $transparencia = imagecolorallocatealpha($imagen, 0, 0, 0, 127);       
        imagefilltoborder($imagen, 50, 50, $transparencia, $transparencia);
        imagesavealpha($imagen, true);       
        
        $query = "";
        if($capa == "c")
        {
            $orange = imagecolorallocatealpha($imagen, 242, 117, 7, $trans);
            $query = "SELECT gid, string_agg( (cast( ((ST_X(ST_GeometryN(ca.geom,1))-c.xinicial)/c.factor)-$factorLargo as varchar)), ',') x,
                             string_agg( (cast( ($ancho - (ST_Y(ST_GeometryN(ca.geom,1))-c.yinicial)/c.factor)-$factorAncho as varchar)),',' ) y
                      FROM (select min(st_xmin(geom)) xinicial, (max(st_xmax(geom))-min(st_xmin(geom)))/$ancho factor,min(st_ymin(geom)) yinicial from distritos) c ,
                           (SELECT gid ,((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom FROM caminos) ca
                      where ( ((ST_X(ST_GeometryN(ca.geom,1))-c.xinicial)/c.factor) between $Xde and $Xa) and ( ($ancho - (ST_Y(ST_GeometryN(ca.geom,1))-c.yinicial)/c.factor) between $Yde and $Ya)
                      group by gid";
            
            $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");
            while ($row = pg_fetch_row($result))
            {    
                $x = explode(",", $row[1]);
                $y = explode(",", $row[2]);
                
                $xi = 0;
                $xf = 0;
                $yi = 0;
                $yf = 0;
                
                for($i = 0; $i < count($x); $i++)
                {
                    if($i == 0)
                    {
                        $xi = $x[$i];
                        $yi = $y[$i];
                    }
                    else
                    {
                        imageline($imagen , $xi, $yi , $x[$i] , $y[$i] , $orange);
                        $xi = $x[$i];
                        $yi = $y[$i];
                    }                    
                }
            }
        }
        if($capa == "r")
        {
            $yellow = imagecolorallocatealpha($imagen, 238, 231, 41, $trans);
            $query = "SELECT gid, string_agg( (cast( ((ST_X(ST_GeometryN(r.geom,1))-c.xinicial)/c.factor)-$factorLargo as varchar)), ',') x,
                             string_agg( (cast( ($ancho - (ST_Y(ST_GeometryN(r.geom,1))-c.yinicial)/c.factor)-$factorAncho as varchar)),',' ) y
                      FROM (select min(st_xmin(geom)) xinicial, (max(st_xmax(geom))-min(st_xmin(geom)))/$ancho factor,min(st_ymin(geom)) yinicial from distritos) c ,
                           (SELECT gid ,((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom FROM rios) r
                      where ( ((ST_X(ST_GeometryN(r.geom,1))-c.xinicial)/c.factor) between $Xde and $Xa) and ( ($ancho - (ST_Y(ST_GeometryN(r.geom,1))-c.yinicial)/c.factor) between $Yde and $Ya)
                      group by gid";
            
            $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");
            while ($row = pg_fetch_row($result))
            {    
                $x = explode(",", $row[1]);
                $y = explode(",", $row[2]);
                
                $xi = 0;
                $xf = 0;
                $yi = 0;
                $yf = 0;
                
                for($i = 0; $i < count($x); $i++)
                {
                    if($i == 0)
                    {
                        $xi = $x[$i];
                        $yi = $y[$i];
                    }
                    else
                    {
                        imageline($imagen , $xi, $yi , $x[$i] , $y[$i] , $yellow);
                        $xi = $x[$i];
                        $yi = $y[$i];
                    }                    
                }
            }
        }
        
        return ($imagen);
    }
}
