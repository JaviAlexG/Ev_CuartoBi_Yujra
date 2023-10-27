<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <script type= 'text/javascript'>
            
            function validar() {
            nomb_hor=document.formu.nomb_hor.value;
                if(document.formu.nomb_hor.value == ''){
                    alert('Seleccione el horario de la linea');
                    document.formu.nomb_hor.focus();
                    return;
                }
                ventanaCalendario = window.open('lineas_horarios1.php?nomb_hor='+nomb_hor, 'calendario' ,'width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO, status=NO, resizable=YES, location=NO')
            }
            </script>
        </head>

        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class=boton_cerrar'></a>
            <h1>REPORTE DE LINEAS HORARIOS</h1>
            <form method='post' name='formu'>";
            
                echo"<center>
                <table border='1'>
              <tr>
                <th><h3>(*)Seleccione Horario</h3></th>
                <td>
                    <select name='nomb_hor'>
                        <option value=''>Seleccione</option>
                        <option value='T'>Todos</option>
                        <option value='C'>HORARIO LINEA C </option>
                        <option value='A'>HORARIO LINEA A</option>
                        <option value='B'>HORARIO LINEA B</option>
                       
                    </select>
                </td>
              </tr>
              <tr>
                
                <td align='center' colspan='6'>
                    <input type='hidden' name='accion' value=''>
                    <input type='button' value='Aceptar' onclick='validar();'' class='buton2'>

                </td>
              </tr>
             
            </table>
            </form>
            </center>
            </body>
                    </html>";
           

?>