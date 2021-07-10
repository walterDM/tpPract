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
function eliminarDato(idProducto,pagina){
    var eliminar = confirm('De verdad desea eliminar este dato?');
    var categoria=document.getElementById('categ').value;
    var eliminarProducto=document.getElementById('eliminarProducto').value;
    if ( eliminar ) {
          
          $.ajax({
            url: 'ABMProductos.php',
            type: 'POST',
            data: { 
                id: idProducto,
                categ: categoria,
                pag: pagina,
                delete: eliminarProducto,
              
            },
         })
         .done(function(response){
            $("#result").html(response);
         })
         .fail(function(jqXHR){
            console.log(jqXHR.statusText);
         });
         alert('El producto ha sido eliminado');
    }
} 
