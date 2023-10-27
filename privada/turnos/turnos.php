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
       <a  href='turno_nuevo.php'>Nuevo Turno</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>LISTADO DE TURNOS</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', em.nombre, em.apellido) AS empleado ,em.ci ,ho.hora_ingreso, ho.hora_salida,ho.*,IF(ho.hora_salida>'12:00','TARDE','MAÑANA') as turno
                     FROM empleados em, horarios ho
                     WHERE em.id_horario = ho.id_horario
                     AND em.estado <> 'X' 
                     AND ho.estado <> 'X' 
                     ORDER BY em.id_empleado DESC                      
                        ");
$rs = $db->GetAll($sql);
echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>EMPLEADO</th><th>C.I.</th><th>INGRESO</th><th>SALIDA</th><th>TURNO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['empleado']."</td>                        
                        <td>".$fila['ci']."</td>
                        <td>".$fila['hora_ingreso']."</td>
                        <td>".$fila['hora_salida']."</td>
                        <td>".$fila['turno']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_horario"]."' method='post' action='persona_modificar.php'>
                            <input type='hidden' name='id_horario' value='".$fila['id_horario']."'>
                            <a href='javascript:document.formModif".$fila['id_horario'].".submit();' title='Modificar Persona Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_horario"]."' method='post' action='persona_eliminar.php'>
                            <input type='hidden' name='id_horario' value='".$fila["id_horario"]."'>
                            <a href='javascript:document.formElimi".$fila['id_horario'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la persona ".$fila["usuario"]." ?\"))'; location.href='persona_eliminar.php''> 
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