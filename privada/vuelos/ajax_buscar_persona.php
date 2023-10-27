<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$am = $_POST["am"];
$ap = $_POST["ap"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];

//$db->debug=true;

if ($am or $ap or $nombres or $ci){
    $sql3 = $db->Prepare("SELECT*
                            FROM personas
                            WHERE am LIKE ?
                            AND ap LIKE ?
                            AND nombres LIKE ?
                            AND ci LIKE ?
                            AND estado <> 'x'
                            ");
                            
        $rs3 = $db->GetAll($sql3, array($am."%", $ap."%", $nombres."%", $ci."%"));

        if ($rs3) {
            echo"<center>
                 <table width='60%' border='1'>
                 <tr>
                 <th>MATERNO</th><th>PATERNO</th><th>NOMBRES</th><th>C.I</th><th>?</th>
                    </tr>";
            foreach($rs3 as $k => $fila) {
                    $str = $fila["am"];
                    $str1 = $fila["ap"];
                    $str2 = $fila["nombres"];
                    $str3 = $fila["ci"];
            echo"<tr>
                    <td align='center'>".resaltar($am, $str)."</td>
                    <td>".resaltar($ap, $str1)."</td>
                    <td>".resaltar($nombres, $str2)."</td>
                    <td>".resaltar($ci, $str3)."</td>
                    <td align='center'>
                     <input type='radio' name='opcion' value='' onClick='buscar_persona(".$fila["id_persona"].")'>
                    </td>
                </tr>";
            }
                echo"</table>
                </center>";
        } else {
                echo"<center><b> LA PERSONA NO EXISTE !!</b></center></br>";
                echo"<center>
                    <table class='listado'>

                    <tr>
                        <td><b>(*)Materno</b></td>
                        <td><input type='text' name='am1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                    </tr>
                    <tr>
                        <td><b>(*)Paterno</b></td>
                        <td><input type='text' name='ap1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                    </tr>
                    <tr>
                        <td><b>(*)Nombres</b></td><td><input type='text' name='nombres1' size='10'
                        onkeyup='this.value=this.value.toUpperCase()'>
                        </td>
                    </tr>
                    <tr>
                        <td><b>(*)CI</b></td>
                        <td><input type='text' name='ci1' size='10'></td>
                    </tr>
                    <tr>
                        <td><b>(*)Telefono</b></td>
                        <td><input type='text' name='telefono1' size='10'></td>
                    </tr>
                    <tr>
                        <td><b>(*)Direccion</b></td>
                        <td><input type='text' name='direccion1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                    </tr>
            <tr>
                <td aling='center' colspan='2'>
                    <input type='button' value='ADICIONAR PERSONA' onClick='insertar_persona()' >
                    </td>
                   </tr>
                </table> 
                </center>
                ";

        }


}
?>


















