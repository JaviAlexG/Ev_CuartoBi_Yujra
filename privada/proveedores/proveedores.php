<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>
       
       
       
       
         <h1>LISTADO DE PROVEEDORES</h1>
         <center><a  href='proveedor_nuevo.php'>Nuevo Proveedor</a></center>";
         

$sql = $db->Prepare("SELECT *
                     FROM proveedores
                     WHERE estado <> 'X' 
                     ORDER BY id_proveedor DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRES</th><th>APELLIDO</th><th>DIRECCION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['apellido']."</td>
                        <td>".$fila['direccion']."</td>
                        
                        <td align='center'>
                          <form name='formModif".$fila["id_proveedor"]."' method='post' action='proveedor_modificar.php'>
                            <input type='hidden' name='id_proveedor' value='".$fila['id_proveedor']."'>
                            <a href='javascript:document.formModif".$fila['id_proveedor'].".submit();' title='Modificar Proveedor Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_proveedor"]."' method='post' action='proveedor_eliminar.php'>
                            <input type='hidden' name='id_proveedor' value='".$fila["id_proveedor"]."'>
                            <a href='javascript:document.formElimi".$fila['id_proveedor'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al proveedor".$fila["nombre"]." ".$fila["apellido"]." ".$fila["direccion"]." ?\"))'; location.href='proveedor_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>