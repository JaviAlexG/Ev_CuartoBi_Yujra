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
            ventanaCalendario = window.open('hoteles_vuelos1.php' , 'calendario' ,'width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO, status=NO, resizable=YES, location=NO')
            }
            </script>
            <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_personas.js'></script>
           

        </head>

        </head>
        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class=boton_cerrar'></a>
            <h1>REPORTE DE HOTELES</h1>";
            echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
  echo"
          <!------------------INICIO BUSCADOR----------------------->
          <center>
            <form action='#'' method='post' name='formu'>
            <table borde='1' class='listado'>
              <tr>
                <th>
                  <b>Hotel</b><br />
                  <input type='text' name='nombre' value='' size='10' onKeyUp='buscar_personas()'>
                </th>
                <th>
                  <b>Direccion</b><br />
                  <input type='text' name='direccion' value='' size='10' onKeyUp='buscar_personas()'>
                </th>
                <th>
                  <b>Ciudad</b><br />
                  <input type='text' name='ciudad' value='' size='10' onKeyUp='buscar_personas()'>
                </th>
                
                
              </tr>
            </table>
            </form>
          </center>
         <!----------------------FIN BUSCADOR---------------------->";

         echo"<div id='personas1'>";

        
            $sql = $db->Prepare("SELECT CONCAT_WS(' - ',vu.origen, vu.destino) AS vuelo, ho.codigo, ho.nombre, ho.telefonos, ho.direccion,ho.ciudad,ho.id_hotel
		 					FROM hoteles ho	
                             INNER JOIN vuelos vu ON vu.id_hotel=ho.id_hotel 					
							");
		    $rs = $db->GetAll($sql);
                if ($rs){
                    echo"<center>
                    


                        <table class='listado'>
                            <tr>
                                <th>Nro</th><th>VUELO</th><th>COD</th><th>HOTEL</th><th>TELEFONOS</th><th>DIRECCION</th>
                            </tr>";
                            $b=1;
                            foreach($rs as $k => $fila){
                                echo"<tr>
                                    <td aling='center'>".$b."</td>
                                    <td>".$fila['vuelo']."</td> 
                                    <td>".$fila['codigo']."</td> 
                                    <td>".$fila['nombre']."</td>
                                    <td>".$fila['telefonos']."</td>
                                    <td>".$fila['direccion']."</td>

                                </tr>";
                                $b=$b+1;
                            }
                            /*echo"</table>
                            <h2>
                                <input type='radio' name='seleccionar' onclick='javascript:imprimir()''>Imprimir
                            </h2>
                            </center>";*/
                }
                echo "</div>";
                echo "</body>
                    </html>";

?>
