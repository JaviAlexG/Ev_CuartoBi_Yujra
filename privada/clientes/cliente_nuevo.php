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

       
         <h1>INSERTAR CLIENTE</h1>
         <center><b><a  href='clientes.php'>Listado de Clientes</a></b></center>";
         
//cambio
/*$sql = $db->Prepare("SELECT *
                     FROM proveedor
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {*/
        echo"<form action='cliente_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th><b>(*)NOMBRE</b></th>
                    <td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)APELLIDO</b></th>
                    <td><input type='text' name='apellido' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)DIRECCION</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>                    
                  </tr>
                  <tr>
                    <th><b>(*)TELEFONO</b></th>
                    <td><input type='text' name='telefono' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>                    
                  </tr>

                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR CLIENTE'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>