
<!--ventana para Update--->
<div class="modal fade" id="editCt<?php echo $rs['idPc'];?>"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ffb74d !important;">
        <h6 class="modal-title" style="color: #fff; text-align: center;">
            Actualizar Contacto
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      

      <form method="POST" action="recibUpdateCt.php">
        <input type="hidden" name="idct" value="<?php echo $rs['idPc']; ?>">

            <div class="modal-body" id="cont_modal">

                <div class="form-group">
             
                  <label for="recipient-name" class="col-form-label">Contacto</label>
                  <input type="text" name="descripcion" class="form-control" value="<?php echo $rs['pcd']; ?>" required="true">
                </div>
                
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
       </form>

    </div>
  </div>
</div>
<!---fin ventana Update --->
