function buscar(){
    $.ajax({
        url: 'login.php',
        type: 'POST',
        data: { 
            contrasenia: document.getElementById('contrasenia').value, 
            us: document.getElementById('us').value, 

        },
    })
    .done(function(response){
        $("#result").html(response);
    })
    .fail(function(jqXHR){
        console.log(jqXHR.statusText);
    });
}