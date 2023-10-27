<?php
session_start();
require_once("../../conexion.php");


$id_empleado = $_REQUEST["id_empleado"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";


$sql = $db->Prepare("SELECT *
                    FROM calzados
                    WHERE id_empleado = ?
                    AND estado <> 'X'
                    ");
           
$rs = $db->GetAll($sql, array($id_empleado));
require_once("../../libreria_menu.php");
if(!$rs) {
    $reg = array();
    $reg["estado"] = "X";
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("empleados", $reg, "UPDATE", "id_empleado='".$id_empleado."'"); 
    header("Location: empleados.php");
    exit();
}else{
    echo"<div class='mensaje'>";
         $mensage = "NO SE ELIMINARON LOS DATOS DEL EMPLEADO PORQUE TIENE HERENCIA";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='empleados.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
}

echo"</body>
</html>";
?>