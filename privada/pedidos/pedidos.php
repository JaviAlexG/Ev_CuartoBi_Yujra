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
       
       
       
         <h1>LISTADO DE PEDIDO</h1>
         <center><a  href='pedido_nuevo.php'>Nueva Pedido</a><center>";
         


$sql = $db->Prepare("SELECT *
                     FROM pedidos pe, clientes cli
                     WHERE pe.id_cliente=cli.id_cliente AND pe.estado <> 'X' AND cli.estado <> 'X'
                     ORDER BY id_pedido DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRE</th><th>APELLIDO</th><th>MONTO TOTAL</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['apellido']."</td>
                        
                        <td align='center'>".$fila['monto_total']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_pedido"]."' method='post' action='pedido_modificar.php'>
                            <input type='hidden' name='id_pedido' value='".$fila['id_pedido']."'>
                            <a href='javascript:document.formModif".$fila['id_pedido'].".submit();' title='Modificar Empleado Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_pedido"]."' method='post' action='pedido_eliminar.php'>
                            <input type='hidden' name='id_pedido' value='".$fila["id_pedido"]."'>
                            <a href='javascript:document.formElimi".$fila['id_pedido'].".submit();' title='Eliminar Pedido Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar el Pedido de ".$fila["nombre"]." ".$fila["apellido"]." ?\"))'; location.href='pedido_eliminar.php''> 
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