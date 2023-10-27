<?php
session_start();
require_once("../../conexion.php");

$id_horario = $_POST["id_horario"];

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='horarios.php'>Listado de Horarios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>MODIFICAR HORARIO</h1>";
         echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

$sql = $db->prepare("SELECT *
                     FROM horarios
                     WHERE id_horario = ?
                     AND estado <> 'X'
                        ");
                        
$rs = $db->GetAll($sql, array($id_horario));

foreach ($rs as $k => $fila){

    echo"<form action='horario_modificar1.php' method='post' name='formu'>";
    echo"<center>
            <table class='listado'>
              
              <tr>
                <th><b>(*)Ingreso</b></th><td><input type='time' name='hora_ingreso' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["hora_ingreso"]."'>
                </td>
              </tr>

              <tr>
                <th><b>Salida</b></th>
                <td><input type='time' name='hora_salida' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["hora_salida"]."'>
                </td>                    
              </tr>
              
              
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR HORARIO'  >
                  <input type='hidden' name='id_horario' value='".$fila["id_horario"]."'
                </td>
              </tr>
            </table>
            </center>";


      echo"</form>" ;     
}
echo "</body>
      </html> ";
      
?>