<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$tipo_texto = $_POST["id_tipo_texto"];

//$db->debug=true;

$sql3 = $db->Prepare("SELECT*
                       FROM tipos_textos
                       WHERE id_tipo_texto
                       ");
$rs3 = $db->GetAll($sql3, array($id_tipo_texto));

echo"<center>
        <table width='60%' border='1'> 
            <tr>
              <th colspan='4'>Datos del Texto</th>
              </tr>
              
              ";
        foreach ($rs3 as $k => $fila){
            echo"<tr>
 
                    <td>".$fila["tipo_texto"]."</td>
                    </tr>";
        }  
        echo"</table>
             </center>";

             ?>

