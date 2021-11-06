<!DOCTYPE html>
<html>
    <head>
      <style>
            .container{
                        width: 90%;
                        max-width: 1200px;
                        margin: auto;
                        
                        
	        }
            .container h3{
                padding-top:40px;
            }
            .cont-menu nav a{
                        display: block;
                        text-decoration: none;
                        padding: 20px;
                    
                        border-left: 5px solid transparent;
                        /*display: inline-block;*/
                    
                        line-height: normal;
                    
                        color: #ff9800;
                        transition: all 0.3s ease;
                        border-bottom: 2px solid transparent;
                        font-size: 25px;
                        margin-right: 5px;
                        
            }
            #detalles{
                padding-top:20px;
            }
            
   
      </style>
    </head>
    <body>
         <?php require("header.php");?>
         <div class="container">
             <h3 align="center">Mi cuenta</h3>
             <div class="row">
                
                <div class="col-md-4">
                    <div class="container">
                        <div class="container-menu">
                            <div class="cont-menu">
                                <nav>
                                    <a href="#/tarjetas">Tarjetas de crédito</a>
                                    <a href="#/perfil">Perfil</a>
                                    <a href="#/direcciones">Direcciones</a>
                                    <a id="enlace4" href="perfilAjax.php?cod=4">Pedidos</a>
                                    <a href="#">Salir</a>
                                
                                </nav>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="detalles">
                    
                </div>
             </div>
         </div>
         <script src="js/perfiles.js"></script>
    </body>    
</html>