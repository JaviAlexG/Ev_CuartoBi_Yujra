<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$funcion = $_POST["funcion"];     
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$ci = $_POST["ci"];

$db->debug=true;

if($funcion or $nombre){
    $sql3 = $db->Prepare("SELECT em.*,fun.*
                            FROM empleados em
                            INNER JOIN funciones fun ON em.id_funcion = fun.id_funcion
                            WHERE fun.funcion LIKE ? 
                            AND em.nombre LIKE ?
                            AND em.apellido LIKE ?
                            AND em.ci LIKE ? 
                            AND fun.estado <> 'X'
                            AND em.estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($funcion."%", $nombre."%", $apellido."%", $ci."%"));
        //$db->debug=true;
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>FUNCION</th><th>NOMBRE</th><th>APELLIDO</th><th>CI</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['funcion'];
                 $str1 = $fila['nombre'];
                 $str2 = $fila['apellido'];
                 $str3 = $fila['ci'];

            echo"<tr>
            <td>".resaltar($funcion, $str)."</td>
                    <td>".resaltar($nombre, $str1)."</td>
                    <td>".resaltar($apellido, $str2)."</td>
                    <td>".resaltar($ci, $str3)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_empleado"]."' method='post' action='empleado_modificar.php'>
                        <input type='hidden' name='id_empleado' value='".$fila['id_empleado']."'>
                        <input type='hidden' name='id_funcion' value='".$fila['id_funcion']."'>
                            <a href='javascript:document.formModif".$fila['id_empleado'].".submit();' title='Modificar Empleado Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_empleado"]."' method='post' action='empleado_eliminar.php'>
                                <input type='hidden' name='id_empleado' value='".$fila["id_empleado"]."'>
                                <a href='javascript:document.formElimi".$fila['id_empleado'].".submit();' title='Eliminar Empleado Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar el empleado..?))'; location.href='empleado_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL EMPLEADO NO EXISTE!!</b></center><br>";

    }
}
?> 