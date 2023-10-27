<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$apellido = $_POST["apellido"];

$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];



//$db->debug=true;

/*echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";*/
       

if($nombre or $apellido or $direccion){
   $sql3 = $db->Prepare("SELECT *
                        FROM clientes
                        WHERE apellido LIKE ?
                        AND nombre LIKE ?
                        AND direccion LIKE ?
                        AND estado <> 'X'
                        ");
    $rs3 = $db->GetAll($sql3,array($apellido."%", $nombre."%", $direccion."%"));
    if($rs3){
        echo"<center>
        <table class='listado'>
            <tr>
                <th>APELLIDO</th><th>NOMBRE</th><th>DIRECCION</th><th> </th>
            </tr>";
            foreach($rs3 as $k=>$fila){
                $str = $fila["apellido"];
                $str1= $fila["nombre"];
                $str2= $fila["direccion"];
                echo"<tr>
                    <td>".resaltar($apellido,$str)."</td>
                    <td>".resaltar($nombre,$str1)."</td>
                    <td>".resaltar($direccion,$str2)."</td>

                    <td align='center'>
                    <input type='radio' name='opcion' value='' onClick='mostrar(".$fila["id_cliente"].")'>                       
                        </td>
                     </tr>";
                    
            }
            echo"</table>
            </center>";
    

} else {
           echo"<center><b>EL CLIENTE NO EXISTE!!</b></center><br>";
   }

}
?> 