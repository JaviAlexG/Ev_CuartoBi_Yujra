<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$id_empresa_calzado = $_POST["id_empresa_calzado"];     
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];


$logo_empresa = $_POST["logo1"];
$nombre_log = $_FILES['logo']['name'];

if(!empty($_FILES['logo']) and is_uploaded_file($_FILES['logo']['tmp_name'])){
    copy($_FILES['logo']['tmp_name'],'logos/'.$nombre_log);
    $logo_empresa= $_FILES['logo']['name'];
}else if($logo_empresa == ""){
    $nombre_log= '';
}else{
    $nombre_log=$logo_empresa;
}


if(($nombre!="") and ($direccion!="")){
   $reg = array();                              
   $reg["id_empresa_calzado"] = 1;

   $reg["nombre"] = $nombre;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;
 
   $reg["logo"] = $nombre_log;
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("empresa_calzados", $reg, "UPDATE","id_empresa_calzado='".$id_empresa_calzado."'"); 
   header("Location: ../../listado_tablas.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON DATOS DE LA EMPRESA DE CALZADOS";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='empresa_calzados.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 