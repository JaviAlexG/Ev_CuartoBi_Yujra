"use strict"
function buscar_clientes(){
    var d1, d2, d3, d4, d11, ajax,url,param, contenedor;
    contenedor=document.getElementById('clientes1');
    d1=document.formu.apellido.value;
    d2=document.formu.nombre.value;
    d3=document.formu.direccion.value;
    ajax=nuevoAjax();
    url="ajax_buscar_clientes.php"
    param="apellido="+d1+"&nombre="+d2+"&direccion="+d3;
    //alert(param);
    ajax.open("POST",url,true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4){
            contenedor.innerHTML=ajax.responseText;
        }
    }
    ajax.send(param);
}