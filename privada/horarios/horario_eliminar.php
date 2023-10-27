<?php
session_start();
require_once("../../conexion.php");

$id_horario = $_REQUEST["id_horario"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$sql = $db->Prepare("SELECT *
                    FROM empleados
                    WHERE id_horario = ?
                    AND estado <> 'X'
                    ");

$rs = $db->GetAll($sql, array($id_horario));

if(!$rs) {
     $reg = array();
     $reg["estado"] = "X";
     $reg["usuario"] = $_SESSION["sesion_id_usuario"];
     $rs1 = $db->AutoExecute("horarios", $reg, "UPDATE", "id_horario='".$id_horario."'"); 
     header("Location: horarios.php");
     exit();
 }else{
     echo"<div class='mensaje'>";
          $mensage = "NO SE ELIMINÓ EL HORARIO PORQUE TIENE HERENCIA";
          echo"<h1>".$mensage."</h1>";
          
          echo"<a href='horarios.php'>
                    <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
               </a>     
              ";
         echo"</div>" ;
 }
echo"</body>
</html>";
?>