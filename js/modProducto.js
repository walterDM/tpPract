$(document).ready(function(){
    $("#cbxTipoProducto").change(function () {
        
        $('#cbxMarca').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
        
        $("#cbxTipoProducto option:selected").each(function () {
            id_estado = $(this).val();
            $.post("includes/getMarcar.php", { id_estado: id_estado }, function(data){
                $("#cbxMarca").html(data);
            });            
        });
    })
});

$(document).ready(function(){
    $("#cbxTipoProducto").change(function () {	
        $("#cbxTipoProducto option:selected").each(function () {
            id_estado = $(this).val();
            $.post("includes/getMarcar.php", { id_estado: id_estado }, function(data){
                $("#cbxMarca").html(data);
            });            
        });
    })

    $("#fupForm").on('submit', function(e){
        e.preventDefault();
    $.ajax({
        url: 'ABMproductos.php',
        type: 'POST',
        data:new FormData(this),

        
            contentType: false,
            cache: false,
            processData:false,
    })
    .done(function(response){
        $("#result").html(response);
    })
    .fail(function(jqXHR){
        console.log(jqXHR.statusText);
    });
  });
  
});

/*function eliminar(){
    $.ajax({
        url: 'ABMproductos.php',
        type: 'POST',
        data: { 
           
            eliminarProducto: document.getElementById('eliminarProducto').value,
            i: document.getElementById('i').value, 
            

        },
    })
    .done(function(response){
        $("#result").html(response);
    })
    .fail(function(jqXHR){
        console.log(jqXHR.statusText);
    });
}*/
function objetoAjax(){
    var xmlhttp=false;
    try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    try {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
    xmlhttp = false;
    }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
      }
      return xmlhttp;
   }
   function eliminarDato(idProducto){
      //donde se mostrará el resultado de la eliminacion
      
      
      //usaremos un cuadro de confirmacion 
      var eliminar = confirm("De verdad desea eliminar este dato?")
      if ( eliminar ) {
      //instanciamos el objetoAjax
      ajax=objetoAjax();
      //uso del medotod GET
      //indicamos el archivo que realizará el proceso de eliminación
      //junto con un valor que representa el id del empleado
      ajax.open("GET", "eliminacion.php?idempleado="+idProducto);
      ajax.onreadystatechange=function() {
      if (ajax.readyState==4) {
      //mostrar resultados en esta capa
      divResultado.innerHTML = ajax.responseText
      }
      }
      //como hacemos uso del metodo GET
      //colocamos null
      ajax.send(null)
      }
   }