<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_clientes.js'></script>
         <script type='text/javascript' src='js/mostrar_clientes.js'></script>

       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>FICHA TECNICA DE CLIENTES</h1>";
         echo"
          <!------------------INICIO BUSCADOR----------------------->
          <center>
            <form action='#'' method='post' name='formu'>
            <table borde='1' class='listado'>
              <tr>
                <th>
                  <b>Apellido</b><br />
                  <input type='text' name='apellido' value='' size='10' onKeyUp='buscar_clientes()'>
                </th>
                <th>
                  <b>Nombre</b><br />
                  <input type='text' name='nombre' value='' size='10' onKeyUp='buscar_clientes()'>
                </th>
                <th>
                  <b>Direccion.</b><br />
                  <input type='text' name='direccion' value='' size='10' onKeyUp='buscar_clientes()'>
                </th>
              </tr>
            </table>
            </form>
          </center>
         <!----------------------FIN BUSCADOR---------------------->";
         echo"<div id='clientes1'>";
        echo"</div>";
        echo "</body>
            </html> ";

 ?>