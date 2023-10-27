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
      
       
       
         <h1>INSERTAR PEDIDO</h1>
         <center><a  href='pedidos.php'>Listado de Pedidos</a></center>";
        
$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,cli.nombre,cli.apellido) as cliente,cli.id_cliente, pe.monto_total
                     FROM clientes cli, pedidos pe
                     WHERE cli.id_cliente=pe.id_cliente AND cli.estado <> 'X'  AND pe.estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='pedido_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Cliente</th>
                    <td>
                      <select name='id_cliente'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_cliente']."'>".$fila['cliente']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Monto Pedido</b></th>
                    <td><input type='text' name='monto_total' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>                
                  
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR PEDIDO'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    }

echo "</body>
      </html> ";

 ?>