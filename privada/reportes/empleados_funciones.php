<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <script type= 'text/javascript'>
            var ventanaCalendario=false
            function imprimir() {
            ventanaCalendario = window.open('empleados_funciones1.php' , 'calendario' ,'width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO, status=NO, resizable=YES, location=NO')
            }
            </script>

            <script type='text/javascript'>
            var ventanaCalendario=false
            function generar_pdf() {
                ventanaCalendario = window.open('empleados_funciones_pdf.php' , 'calendario' ,'width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO, status=NO, resizable=YES, location=NO')
            }
            </script>
        </head>

        </head>
        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class=boton_cerrar'></a>
            <h1>REPORTE DE EMPLEADOS Y FUNCIONES</h1>";
            echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
        
            $sql = $db->Prepare("SELECT CONCAT_WS(' ',em.nombre,em.apellido) as persona, fun.funcion
		 					FROM empleados em		 					
		 					INNER JOIN funciones fun ON em.id_funcion=fun.id_funcion
                            WHERE em.estado ='A'
							AND fun.estado = 'A'
							");
		    $rs = $db->GetAll($sql);
                if ($rs){
                    echo"<center>
                        <table class='listado'>
                            <tr>
                                <th>Nro</th><th>EMPLEADOS</th><th>FUNCION</th>
                            </tr>";
                            $b=1;
                            foreach($rs as $k => $fila){
                                echo"<tr>
                                    <td aling='center'>".$b."</td>
                                    <td>".$fila['persona']."</td>
                                    <td>".$fila['funcion']."</td>

                                </tr>";
                                $b=$b+1;
                            }
                            echo"</table>
                            <h2>
                                <input type='radio' name='seleccionar' onclick='javascript:imprimir()''>Imprimir
                            </h2>
                            <h2>
                            <input type='radio' name='seleccionar' onclick='javascript:generar_pdf()'>Generar pdf
                            </h2>

                            </center>";
                }
                echo "</body>
                    </html>";

?>
