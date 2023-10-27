<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='turnos.php'>Listado de Turnos</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>INSERTAR CAMBIO DE TURNO</h1>";
         echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,em.nombre, em.apellido) as empleado, ho.id_horario, em.id_empleado
                     FROM empleados em, horarios ho
                     WHERE em.estado <> 'X' and em.id_horario=ho.id_horario                        
                        ");
$rs = $db->GetAll($sql);

   if ($rs) {
        echo"<form action='turno_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Empleado</th>
                    <td>
                      <select name='id_empleado'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_empleado']."'>".$fila['empleado']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Horario Ingreso hh:mm:ss</b></th>
                    <td><input type='time' name='hora_ingreso' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Horario Salida hh:mm:ss</b></th>
                    <td><input type='time' name='hora_salida' size='10'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR TURNO'><br>
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