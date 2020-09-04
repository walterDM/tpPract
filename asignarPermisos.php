
   <?php require("header.php");?>
   
      <div class="row">
          <div class="col-md-12" style="padding-top:60px;">
             <form action="permisos.php" method="post" class="permisos">
               <div class="row">
                <div class="col-md-12">
                  <label>Crear grupo</label>
                  <input type="text" name="nombreGrupo">
                </div><br><br>
                <div class="col-md-3" style="background:#fafafa;border: 1px solid #ffb74d;">
                  <p>Gestion productos</p>
                  <input type="checkbox" name="nombrePermiso[]" value="alta producto">Alta<br>
                  <input type="checkbox" name="nombrePermiso[]" value="baja producto">Baja<br>
                  <input type="checkbox" name="nombrePermiso[]" value="modificar producto">Modificar<br>
                  <input type="checkbox" name="nombrePermiso[]" value="buscar producto">Buscar producto<br>
                  <input type="checkbox" name="nombrePermiso[]" value="realizar envios">Realizar envíos
                </div>
                <div class="col-md-3" style="background:#fafafa;border: 1px solid #ffb74d;">
                  <p>Gestion proveedores</p>
                  <input type="checkbox" name="nombrePermiso[]" value="alta proveedor">Alta<br>
                  <input type="checkbox" name="nombrePermiso[]" value="baja proveedor">Baja<br>
                  <input type="checkbox" name="nombrePermiso[]" value="modificar proveedor">Modificar<br>
                  <input type="checkbox" name="nombrePermiso[]" value="buscar proveedores">Buscar proveedores<br>
                  <input type="checkbox" name="nombrePermiso[]" value="realizar pedidos">Realizar pedidos
                </div>
                <div class="col-md-3" style="background:#fafafa;border: 1px solid #ffb74d;">
                  <p>Gestion usuarios</p>
                  <input type="checkbox" name="nombrePermiso[]" value="alta usuario">Alta<br>
                  <input type="checkbox" name="nombrePermiso[]" value="baja usuario">Baja<br>
                  <input type="checkbox" name="nombrePermiso[]" value="modificar usuario">Modificar<br>
                  <input type="checkbox" name="nombrePermiso[]" value="buscar usuarios">Buscar usuarios<br>
                  <input type="checkbox" name="nombrePermiso[]" value="asignar permisos">Asignar permisos<br>
                  <input type="checkbox" name="nombrePermiso[]" value="listar cliente">Listar cliente
                </div>
                <div class="col-md-3" style="background:#fafafa;border: 1px solid #ffb74d;">
                  <p>Reportes</p>
                  <input type="checkbox" name="nombrePermiso[]" value="reportes de stock">Stock<br>
                  <input type="checkbox" name="nombrePermiso[]" value="reportes de ventas">Ventas<br>
                  <input type="checkbox" name="nombrePermiso[]" value="reportes de caducidad">Caducidad
                </div>
                <div class="col-md-12" align="center">
                    <button type="submit" class="btn btn-light"  name="acept" value="acept">Asignar</button>
                </div>
               </div>
             </form>
          </div>
      </div>
  <?php require 'footer.php' ?>