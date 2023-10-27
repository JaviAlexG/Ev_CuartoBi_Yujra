<?php
session_start();

require_once("../../conexion.php");

$tipo_texto1 = $_POST["tipo_texto1"];




$reg = array();
$reg["id_tipo_texto"] = 1;
$reg["tipo_texto"] = $nombres1;

$reg["usuario"] = $_SESSION["sesion_id_usuario"];
$rs1 = $db->AutoExecute("tipos_textos", $reg, "INSERT");

?>