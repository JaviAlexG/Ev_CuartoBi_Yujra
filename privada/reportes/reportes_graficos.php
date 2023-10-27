<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <script type= 'text/javascript'>
            var ventanaCalendario=false
            function reporte1() {
            ventanaCalendario = window.open('Highcharts1/examples/line-basic/index.php' , 'calendario' ,'width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO, status=NO, resizable=YES, location=NO')
            }
            </script>


            <script type='text/javascript'>
            var ventanaCalendario=false
            function reporte2() {
                ventanaCalendario = window.open('Highcharts1/examples/3d-pie/index.php' , 'calendario' ,'width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO, status=NO, resizable=YES, location=NO')
            }
            </script>


        </head>

        </head>
        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class=boton_cerrar'></a>
            <h1>REPORTES GRAFICOS</h1>";
            echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
        
                    echo"<center>
                        <table class='listado'>
                            <tr>
                                <th>Seleccione el Reporte</th>
                            </tr>";
                            
                            echo"<tr>
                            <td>
                            <input type='radio' name='seleccionar' onclick='javascript:reporte1()'>Reporte 1: LINEAS SALARIO SEGUN FUNCIONES   
                            <td> 
                            </tr>

                            <tr>
                            <td>
                            <input type='radio' name='seleccionar' onclick='javascript:reporte2()'>Reporte 2: TORTA 3D PRECIO CALZADOS  
                            <td> 
                            </tr>";
                            echo"</table>
                            </center>";
                
                echo "</body>
                    </html>";

?>



