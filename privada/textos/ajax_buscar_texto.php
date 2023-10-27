<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$tipo_texto = $_POST["tipo_texto"];     
$codigo = $_POST["codigo"];
$texto = $_POST["texto"];
$nro_paginas = $_POST["nro_paginas"];

$db->debug=true;

if($tipo_texto){
    $sql3 = $db->Prepare("SELECT te.*,tip.*
                            FROM textos te
                            INNER JOIN tipos_textos tip ON te.id_tipo_texto = tip.id_tipo_texto
                            WHERE tip.tipo_texto LIKE ? 
                            AND te.codigo LIKE ?
                            AND te.texto LIKE ?
                            AND te.nro_paginas LIKE ? 
                           
                        ");
        $rs3 = $db->GetAll($sql3, array($tipo_texto."%", $codigo."%", $texto."%", $nro_paginas."%"));
        //$db->debug=true;
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>TIPO DE TEXTO</th><th>CODIGO</th><th>TEXTO</th><th>PAGINAS</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['tipo_texto'];
                 $str1 = $fila['codigo'];
                 $str2 = $fila['texto'];
                 $str3 = $fila['nro_paginas'];

            echo"<tr>
            <td>".resaltar($tipo_texto, $str)."</td>
                    <td>".resaltar($codigo, $str1)."</td>
                    <td>".resaltar($texto, $str2)."</td>
                    <td>".resaltar($nro_paginas, $str3)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_texto"]."' method='post' action='texto_modificar.php'>
                        <input type='hidden' name='id_texto' value='".$fila['id_texto']."'>
                        <input type='hidden' name='id_tipo_texto' value='".$fila['id_tipo_texto']."'>
                            <a href='javascript:document.formModif".$fila['id_texto'].".submit();' title='Modificar Empleado Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_texto"]."' method='post' action='texto_eliminar.php'>
                                <input type='hidden' name='id_texto' value='".$fila["id_texto"]."'>
                                <a href='javascript:document.formElimi".$fila['id_texto'].".submit();' title='Eliminar Empleado Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar el empleado..?))'; location.href='texto_eliminar.php''>
                                Eliminar>>
                                
                                </a>
                              </form>                        
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