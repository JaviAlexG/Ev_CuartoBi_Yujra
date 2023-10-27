<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            

            <script type='text/javascript'>
            var ventanaCalendario=false
            function generar_pdf() {
                ventanaCalendario = window.open('reportes_pdf1.php' , 'calendario' ,'width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO, status=NO, resizable=YES, location=NO')
            }
            </script>
        </head>

        </head>
        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class=boton_cerrar'></a>
            <h1>REPORTE DE EMPLEADOS CON HORARIOS Y FUNCIONES</h1>";
            echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
        
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',cli.nombre,cli.apellido) as persona, pe.monto_total
                        FROM pedidos pe		 					
                        INNER JOIN clientes cli ON pe.id_cliente=cli.id_cliente
                        WHERE pe.estado ='A'
                        AND cli.estado = 'A'
                        ");
		    $rs = $db->GetAll($sql);
                if ($rs){
                    echo"<center>
                        <table class='listado'>
                            <tr>
                                <th>Nro</th><th>CLIENTES</th><th>MONTO TOTAL</th>
                            </tr>";
                            $b=1;
                            foreach($rs as $k => $fila){
                                echo"<tr>
                                    <td aling='center'>".$b."</td>
                                    <td>".$fila['persona']."</td>
                                    <td>".$fila['monto_total']."</td>

                                </tr>";
                                $b=$b+1;
                            }
                            echo"</table>
                            
                            <h2>
                            <input type='radio' name='seleccionar' onclick='javascript:generar_pdf()'>Generar pdf
                            </h2>

                            </center>";
                }
                echo "</body>
                    </html>";

?>
