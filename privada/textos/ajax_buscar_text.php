<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$tipo_texto = $_POST["tipo_texto"];     
/*$codigo = $_POST["codigo"];
$texto = $_POST["texto"];
$nro_paginas = $_POST["nro_paginas"];*/

$db->debug=true;

if($tipo_texto){
    $sql3 = $db->Prepare("SELECT *
                            FROM tipos_textos
                            WHERE tipo_texto LIKE ? 

                           
                        ");
        $rs3 = $db->GetAll($sql3, array($tipo_texto."%"));
        //$db->debug=true;
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>TIPO DE TEXTO</th><th> </th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['tipo_texto'];


            echo"<tr>
            <td>".resaltar($tipo_texto, $str)."</td>

            <td align='center'>
            <input type='radio' name='opcion' value='' onClick='buscar_texto(".$fila["id_tipo_texto"].")'>
           </td>
                         </tr>";
                        
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL TEXTO NO EXISTE!!</b></center><br>";

    }
}
?> 