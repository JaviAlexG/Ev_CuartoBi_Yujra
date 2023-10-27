<?php
session_start();
require_once("../../conexion.php");

$id_funcion = '{$_POST["id_funcion"]}';
$id_empleado = $_POST["id_empleado"];

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='empleados.php'>Listado de Empleados</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>MODIFICAR EMPLEADO</h1>";
         echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

$sql = $db->prepare("SELECT *
                     FROM empleados
                     WHERE id_empleado = ?
                     AND estado = 'A'
                        ");
                        
$rs = $db->GetAll($sql, array($id_empleado));

//nuevo



$sql1 = $db->prepare("SELECT funcion, id_funcion
                     FROM funciones
                     WHERE id_funcion = ?
                     AND estado = 'A'
                        ");


                        
$rs1 = $db->GetAll($sql1, array($id_funcion));

$sql2 = $db->prepare("SELECT funcion, id_funcion
                     FROM funciones
                     WHERE id_funcion <> ?
                     AND estado = 'A'
                        ");
                        
$rs2 = $db->GetAll($sql2, array($id_funcion));



    echo"<form action='empleado_modificar1.php' method='post' name='formu'>";
    echo"<center>
            <table class='listado'>
              <tr>
                <th>Funcion</th>
                <td>
                  <select name='id_funcion'>";
                    foreach ($rs1 as $k => $fila){
                      echo"<option value='".$fila['id_funcion']."'>".$fila['funcion']."</option>";
                    }

                    foreach ($rs2 as $k => $fila){
                      echo"<option value='".$fila['id_funcion']."'>".$fila['funcion']."</option>";
                    }

                echo"</select>
                </td>
              </tr>";
              foreach ($rs as $k => $fila){
              
                echo"<tr>
                <th><b>Nombre</b></th>
                <td><input type='text' name='nombre' size='10'  value='".$fila["nombre"]."'>
                </td>                    
              </tr>
              <tr>
              <th><b>Apellido</b></th>
              <td><input type='text' name='apellido' size='10'  value='".$fila["apellido"]."'>
              </td> 
              </tr>

              
              <tr>
              <th><b>CI</b></th>
              <td><input type='text' name='ci' size='10'  value='".$fila["ci"]."'>
              </td> 
              </tr>

              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR EMPLEADO'  >
                  <input type='hidden' name='id_empleado' value='".$fila["id_empleado"]."'
                </td>
              </tr>";

          }
            echo"</table>
            </center>";


      echo"</form>";     

echo "</body>
      </html>";
      
?>