<?php 
require("conexion.php");
require("header.php");

// $select2=mysqli_query($conexion,"SELECT * FROM grupos");
?>
 <div class="row">
             <div class="col-md-12 info" id="inicio">
                
             <div class="container" style="padding-top: 40px">
                <div class="preguntas" style="background: #ffa726">
                    <h2 align="center"><steong>Preguntas Frecuentes</steong></h2>
                   <div class="accordion" id="accordionExample">
                      <div class="card">
                          <div class="card-header" id="headingOne">
                              <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  ¿Qué formas de pago disponen?
                                </button>
                              </h2>
                          </div>
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                               <div class="card-body">
                                  <p>Disponemos de las siguientes formas de pagos:</p>
                                  <img style="width: 20%" src="https://www.palasado.com/wp-content/uploads/2018/09/visa-and-mastercard-logos-logo-visa-png-logo-visa-mastercard-png-visa-logo-white-png-awesome-logos.png">
                               </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  ¿Cuál es el costo del envío?
                                </button>
                              </h2>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                               <div class="card-body">
                                  <p>El costo de envio dentro de la Ciudad de Buenos Aires esta  entre $200 y $450.<br>
                                   Resto del pais : $550 a $650
                                  </p>
                               </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingThree">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  ¿Cómo se realizan los envíos?
                                </button>
                             </h2>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                               <div class="card-body">
                                  <p>Trabajamos con:</p>
                                  <p>
                                    Ciudad de Buenos Aires: Empresa de mensajeria a domicilio<br>
                                    Resto del país: Correo OCA EPACK o mercado envios Correo Argentino
                                  </p>
                               </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingFour">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                  ¿Dónde puedo recibir mi pedido?
                                </button>
                             </h2>
                          </div>
                          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                               <div class="card-body">
                                  <p>Realizamos envíos a todo el país. los productos seran enviados al domicilio selecionado en el momento de la compra.</p>
                               
                               </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingFive">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                  ¿Cuánto tarda en llegar el pedido?
                                </button>
                             </h2>
                          </div>
                          <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                               <div class="card-body">
                                  <p>El tiempo de entrega dependerá del tipo de envío seleccionado. En general la demora se encuentra entre 2 y 6 días hábiles luego de despacharse. (Son despachados dentro de las 96 hs confirmado el pago)</p>
                               </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingSix">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                  ¿Qué pasa si mi pedido regresa a origen?
                                </button>
                             </h2>
                          </div>
                          <div id="collapseSix" class="collapse" aria-labelledby="headingSixs" data-parent="#accordionExample">
                               <div class="card-body">
                                  <p>
                                    Si es un envio con oca, se deberá abonar el costo de envio de ida y vuelta del paquete y se volverá a mandar.<br>
                                    Si es con mercado envios, la compra se cancela automáticamente y puede volver a hacer otra.
                                  </p>
                               </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingSeven">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                  ¿Cuál es el plazo para realizar el cambio?
                                </button>
                             </h2>
                          </div>
                          <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                               <div class="card-body">
                                  <p>Puedes solicitar un cambio hasta 15 días luego de realizada la compra.</p><br>
                                  <p><strong>IMPORTANTE: los productos en SALE, NO tienen cambio.</strong></p>
                               </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="headingEight">
                              <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                  ¿Qué debo hacer si el producto no llega en buen estado?
                                </button>
                             </h2>
                          </div>
                          <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                               <div class="card-body">
                                  <p>Ponte en contacto con nosotros  y te enviaremos uno nuevo.</p>

                                   <a class="nav-link" href="contacto.php">Contactactanos</a>
                                 
                               </div>
                          </div>
                      </div>
                   </div>
                </div>
             </div>
         </div>
       </div>
         <br clear="all">
 

<?php require 'footer.php'; ?>