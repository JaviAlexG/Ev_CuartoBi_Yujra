<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$nomb_hor = $_REQUEST["nomb_hor"];
$fecha= date("Y-m-d H:i:s");




echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

if($nomb_hor == "T"){
   /*$sql = $db->Prepare("SELECT CONCAT_WS(' ',ap,am,nombres) as persona, if (genero= 'F','FEMENINO',   'MASCULINO') AS genero
                        FROM personas
                        WHERE estado <> 'X' 
                        ");
    $rs = $db->GetAll($sql);*/



    $sql = $db->Prepare("SELECT nomb_hor,ini_linea,fin_linea
		 					FROM horario 		 					
							");
		    $rs = $db->GetAll($sql);

} else if($nomb_hor == "C"){
    $sql = $db->Prepare("SELECT nomb_hor,ini_linea,fin_linea,id_horario
    FROM horario

    WHERE id_horario = '1'
    ");
$rs = $db->GetAll($sql);
   }else if($nomb_hor == "A"){
    $sql = $db->Prepare("SELECT nomb_hor,ini_linea,fin_linea,id_horario
    FROM horario

    WHERE id_horario = '2'
    ");
$rs = $db->GetAll($sql);

   }else if($nomb_hor == "B"){
    $sql = $db->Prepare("SELECT nomb_hor,ini_linea,fin_linea,id_horario
    FROM horario

    WHERE id_horario = '3'
    ");
$rs = $db->GetAll($sql);
   }


   $sql1 = $db->Prepare("SELECT *
    FROM empresa_calzados
    WHERE id_empresa_calzado=1
    AND estado <> 'X' 
    ");
$rs1 = $db->GetAll($sql1);
$nombre=$rs1[0]["nombre"];
$logo =$rs1[0]["logo"];

   echo"<html> 
   <head>
     
     <script type='text/javascript'>

     var ventanaCalendario=false
            function imprimir() {
            if(confirm(' Desea imprimir ?')){
                window.print();
            }
        }
            </script>
   </head>
   <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";
   if($rs){
    echo"<table widh='100%'' border='0'>
        <tr>
            <td><img src='../empresa/logos/{$logo}' width='70%'></td>
            <td align='center'  width='80%'><h1>REPORTES HORARIOS</h1></td>
        </tr>
    </table>";
    echo"<center>
        <table border='1' cellspacing='0'>
            <tr>
                <th>Nro</th><th>LINEA</th><th>HORA INICIO</th><th>HORA FIN</th>
            </tr>";
            $b=1;
            foreach($rs as $k => $fila){
                echo"<tr>
                    <td aling='center'>".$b."</td>
                    <td>".$fila['nomb_hor']."</td>
                    <td>".$fila['ini_linea']."</td>
                    <td>".$fila['fin_linea']."</td>
                </tr>";
                $b=$b+1;
            }
        echo"</table><br>
        <b>Fecha :</b>".$fecha."</center>";
   }
echo "</body>
  </html> ";
?> 