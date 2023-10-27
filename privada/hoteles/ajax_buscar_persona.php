<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];


$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

if($nombre or $direccion or $ciudad){
   $sql3 = $db->Prepare("SELECT *
                        FROM hoteles
                        WHERE nombre LIKE ?
                        AND ciudad LIKE ?
                        AND direccion LIKE ?
                        ");
    $rs3 = $db->GetAll($sql3,array($nombre."%",$ciudad."%",$direccion."%"));
    if($rs3){
        echo"<center>
        <table class='listado'>
            <tr>
                <th>HOTEL</th><th>DIRECCION</th><th>CIUDAD</th><img src'../../imagenes/modificar.gif'></th><th img src='../../imagenes/borrar.jpeg'></th>
            </tr>";
            foreach($rs3 as $k=>$fila){
                $str = $fila["nombre"];
                $str1= $fila["direccion"];
                $str2= $fila["ciudad"];
                echo"<tr>

                    <td>".resaltar($nombre,$str)."</td>
                    <td>".resaltar($direccion,$str1)."</td>
                    <td>".resaltar($ciudad,$str2)."</td>
                    
                     </tr>";
                    
            }
            echo"</table>
            </center>";
    

} else {
           echo"<center><b>EL HOTEL NO EXISTE</b></center><br>";
   }

}
?> 