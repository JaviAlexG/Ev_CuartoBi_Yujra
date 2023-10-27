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
       <a  href='horarios.php'>Listado de Horarios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>INSERTAR HORARIO</h1>";
         echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
//cambio
/*$sql = $db->Prepare("SELECT *
                     FROM personas
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {*/
        echo"<form action='horario_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                <th><b>(*)Horario Ingreso hh:mm:ss</b></th>
                <td><input type='time' name='hora_ingreso' size='10'></td>
              </tr>
              <tr>
                <th><b>(*)Horario Salida hh:mm:ss</b></th>
                <td><input type='time' name='hora_salida' size='10'></td>
              </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR HORARIO'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>