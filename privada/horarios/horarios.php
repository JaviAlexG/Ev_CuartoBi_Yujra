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
       <a  href='horario_nuevo.php'>Nuevo Horario</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>LISTADO DE HORARIOS</h1>";
         echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

$sql = $db->Prepare("SELECT *
                     FROM horarios
                     WHERE estado <> 'X' 
                     ORDER BY id_horario DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>HORA_INGRESO</th><th>HORA_SALIDA</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['hora_ingreso']."</td>
                        <td>".$fila['hora_salida']."</td>                        
                        <td align='center'>
                          <form name='formModif".$fila["id_horario"]."' method='post' action='horario_modificar.php'>
                            <input type='hidden' name='id_horario' value='".$fila['id_horario']."'>
                            <a href='javascript:document.formModif".$fila['id_horario'].".submit();' title='Modificar Persona Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_horario"]."' method='post' action='horario_eliminar.php'>
                            <input type='hidden' name='id_horario' value='".$fila["id_horario"]."'>
                            <a href='javascript:document.formElimi".$fila['id_horario'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar este horario ".$fila["hora_ingreso"]." ".$fila["hora_salida"]."?\"))'; location.href='horario_eliminar.php''> 
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