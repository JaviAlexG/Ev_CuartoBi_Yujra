"use strict"
function mostrar(id_cliente){
    var d1, ventanaCalendario;
    d1 = id_cliente;
    ventanaCalendario = window.open("ficha_tec_clientes1.php?id_cliente=" + d1 , "calendario", "width=600, height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,status=NO,resizable=YES,location=NO")
}