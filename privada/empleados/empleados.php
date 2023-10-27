<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_empleado.js'> </script>
       </head>
       <body>
       <p> &nbsp;</p>

       
         <h1>LISTADO DE EMPLEADOS</h1>
         <center><a  href='empleado_nuevo.php'>Nueva Empleado</a></center>";

$sql = $db->Prepare("SELECT *
                    FROM funciones 
                    WHERE estado <> 'X'                   
                        ");
$rs = $db->GetAll($sql);

echo"
<!------INICIO BUSCADOR---------------->
    <center>
     <form action='#'' method='post' name='formu'>
     <table border='1' class='listado'>
    <tr>
    <th>
     <b>FUNCION DE EMPLEADO</b><br />
     <select name='funcion' onChange='buscar_empleado()'>
     <option value=''>--Seleccione--</option>";
     foreach ($rs as $k => $fila) {
     echo"<option value='".$fila['funcion']."'>".$fila['funcion']."</option>";
     }  

echo"</select>
</th> 
        <th>
          <b>Nombre</b><br />
          <input type='text' name='nombre' value='' size='10' onKeyUp='buscar_empleado()'>
        </th>
        <th>
          <b>Apellido</b><br />
          <input type='text' name='apellido' value='' size='10' onKeyUp='buscar_empleado()'>
        </th>
        <th>
          <b>C.I.</b><br />
          <input type='text' name='ci' value='' size='10' onKeyUp='buscar_empleado()'>
        </th>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";

echo"<div id='empleados1'> ";


$elementosPorPagina = 8;
$Paginas = isset($_GET['page']) ? $_GET['page'] : 1;
$sqlElementos = $db->Prepare("SELECT COUNT(*) 
                              FROM empleados 
                              WHERE estado <> 'X'");
$totalElementos = $db->GetOne($sqlElementos);
$offset = ($Paginas - 1) * $elementosPorPagina;



$sql = $db->Prepare("SELECT *
                     FROM empleados em, funciones fun
                     WHERE em.id_funcion=fun.id_funcion AND em.estado <> 'X' AND fun.estado <> 'X'
                     ORDER BY id_empleado DESC
                     LIMIT $offset, $elementosPorPagina      
                        ");
$rs = $db->GetAll($sql);

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>C.I.</th><th>APELLIDO</th><th>NOMBRES</th><th>FUNCION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['ci']."</td>
                        <td>".$fila['apellido']."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['funcion']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_empleado"]."' method='post' action='empleado_modificar.php'>
                            <input type='hidden' name='id_empleado' value='".$fila['id_empleado']."'>
                            <a href='javascript:document.formModif".$fila['id_empleado'].".submit();' title='Modificar Empleado Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_empleado"]."' method='post' action='empleado_eliminar.php'>
                            <input type='hidden' name='id_empleado' value='".$fila["id_empleado"]."'>
                            <a href='javascript:document.formElimi".$fila['id_empleado'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al empleado ".$fila["nombre"]." ".$fila["apellido"]." ?\"))'; location.href='empleado_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
                  
        $numPaginas = ceil($totalElementos / $elementosPorPagina);
        echo "<br><div class='pagination' style='text-align: center;'>";
        for ($i = 1; $i <= $numPaginas; $i++) {
        echo "<a href='?page=" . $i . "'>" . $i . "</a> ";
        }
        echo "</div>";
    }

echo "</body>
      </html> ";

 ?>