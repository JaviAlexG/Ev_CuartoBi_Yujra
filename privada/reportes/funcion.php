<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <script type= 'text/javascript'>
            
            function validar() {
            funcion=document.formu.funcion.value;
                if(document.formu.funcion.value == ''){
                    alert('Seleccione la funcion del empleado');
                    document.formu.funcion.focus();
                    return;
                }
                ventanaCalendario = window.open('funcion1.php?funcion='+funcion, 'calendario' ,'width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO, status=NO, resizable=YES, location=NO')
            }
            </script>
        </head>

        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class=boton_cerrar'></a>
            <h1>REPORTE DE EMPLEADOS SEGUN FUNCIONES</h1>
            <form method='post' name='formu'>";
            
                echo"<center>
                <table border='1'>
              <tr>
                <th><h3>(*)Seleccione funcion</h3></th>
                <td>
                    <select name='funcion'>
                        <option value=''>Seleccione</option>
                        <option value='T'>Todos</option>
                        <option value='TRANSPORTE'>TRANSPORTE</option>
                        <option value='GTE. ADMINISTRATIVO'>GTE. ADMINISTRATIVO</option>
                        <option value='EMPLEADO'>EMPLEADO</option>
                        <option value='GTE. COMERCIAL'>GTE. COMERCIAL</option>
                        <option value='GTE. PRODUCCION'>GTE. PRODUCCION</option>
                        <option value='GTE. FINANZAS'>GTE. FINANZAS</option>
                        <option value='SUPERVISOR'>SUPERVISOR</option>
                        <option value='ENCARGADO DE VENTAS'>ENCARGADO DE VENTAS</option>
                        <option value='DISEÑADOR'>DISEÑADOR</option>
                        <option value='SUPERV. DE DISTRIBUCION'>SUPERV. DE DISTRIBUCION</option>
                        <option value='SUPERV DE VENTAS'>SUPERV DE VENTAS</option>
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