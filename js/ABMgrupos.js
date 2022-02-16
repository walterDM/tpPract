$(document).ready(function(){

    $("#fupForm").on('submit', function(e){
        e.preventDefault();
    $.ajax({
        url: 'ABMgrupos.php',
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
function eliminarDato(idGrupo,pagina){
    var eliminar = confirm('De verdad desea eliminar este grupo?');
    var eliminarGrupo=document.getElementById('eliminarGrupo').value;
    if ( eliminar ) {
          
          $.ajax({
            url: 'ABMgrupos.php',
            type: 'POST',
            data: { 
                id: idGrupo,
                pag: pagina,
                delete: eliminarGrupo,
              
            },
         })
         .done(function(response){
            $("#result").html(response);
         })
         .fail(function(jqXHR){
            console.log(jqXHR.statusText);
         });
         alert('El grupo ha sido eliminado');
    }
} 
