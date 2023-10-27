<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
$id_cliente = $_REQUEST["id_cliente"];
$sql = $db->Prepare("SELECT *
                     FROM clientes
                     WHERE id_cliente=?
                     AND estado <> 'X'                                          
                        ");
$rs = $db->GetAll($sql, array($id_cliente));
$sql1 = $db->Prepare("SELECT *
                     FROM empresa_calzados
                     WHERE id_empresa_calzado=1
                     AND estado <> 'X'                     
                        ");
            $rs1 = $db->GetAll($sql1);
            $nombre =$rs1[0]["nombre"];
            $logo =$rs1[0]["logo"];
            echo"<html>
        <head>
           <script type='text/javascript'>
            var ventanaCalendario=false
            function imprimir(){
                if(confirm(' Desea imprimir ?')){
                    window.print();
                }
            } 
           </script>
           </head>
           <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";
           if ($rs){
            echo"<table width='100%' border='0'>
                <td><img src='../empresa/logos/{$logo}' width='70%'></td>
                <td align='center'  width='80%'><h1>REPORTES DE CLIENTES</h1></td>
            </table>";

            echo"
            <center>
                <table border='1' cellspacing='0'>";                
                $b=1;
                foreach($rs as $k => $fila){
                    echo"<tr>
                        <th align='riht'>Apellido</th><th>:</th>
                        <td><input type='text' name='apellido' value='".$fila['apellido']."' disabled=''></td>
                    </tr>
                    <tr>
                        <th align='riht'>Nombre</th><th>:</th>
                        <td><input type='text' name='nombre' value='".$fila['nombre']."' disabled=''></td>
                    </tr>
                    <tr>
                        <th align='riht'>Direccion</th><th>:</th>
                        <td><input type='text' name='direccion' value='".$fila['direccion']."' disabled=''></td>
                    </tr>
                    
                <tr>
                        <th align='riht'>Telefono</th><th>:</th>
                        <td><input type='text' name='telefono' value='".$fila['telefono']."' disabled=''></td>
                    </tr>";

                   
                    echo"
                    </table>";
                    $b=$b+1;
                                        
                }
                
            }
        echo "</body>
            </html>";
?>