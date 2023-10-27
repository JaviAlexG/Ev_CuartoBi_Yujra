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

       
         <h1>INSERTAR EMPLEADO</h1>
         <center><a  href='empleados.php'>Listado de Empleados</a></center>";
         

$sql = $db->Prepare("SELECT DISTINCT CONCAT_WS(' ' ,fun.funcion) as funcion, fun.id_funcion
                     FROM empleados em, funciones fun
                     WHERE em.id_funcion=fun.id_funcion AND fun.estado <> 'X'  AND em.estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='empleado_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Funcion</th>
                    <td>
                      <select name='id_funcion'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_funcion']."'>".$fila['funcion']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Nombre</b></th>
                    <td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Apellido</b></th>
                    <td><input type='text' name='apellido' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)C.I.</b></th>
                    <td><input type='text' name='ci' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR USUARIO'><br>
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