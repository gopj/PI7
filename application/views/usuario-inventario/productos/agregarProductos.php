<div class="row-fluid">
   <div class="span12 offset2">
  <h2 class="offset2">Agregar producto</h2>
    <?= form_open('usuario-inventario/productos/agregarProductos', 'class="form-horizontal"'); ?>
      <div class="control-group">
        <label class="control-label" for="nombre">Nombre producto:</label>
        <div class="controls">
         <input style="height:30px" required type="text" id="nombre" name="nombre" placeholder="Nombre">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="presentacion">Presentacion:</label>
        <div class="controls">
          <div class="input-append">
          <input style="height:30px" required type="text" id="presentacion" name="presentacion" placeholder="Presentacion gr">
          <span class="add-on"> gr</span>
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="precioFabrica">Precio fabrica:</label>
        <div class="controls">
          <div class="input-prepend">
            <span class="add-on">$</span>
            <input style="height:30px" required type="text" id="precioFabrica" name="precioFabrica" placeholder="Precio fabrica">
            
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" required for="precioPublico">Precio publico:</label>
        <div class="controls">
          <div class="input-prepend">
            <span class="add-on">$</span>
            <input style="height:30px" type="text" required id="precioPublico" name="precioPublico" placeholder="Precio publico">
          </div>
        </div>
      </div>
       <div class="control-group">
        <label class="control-label" for="cantidad">Cantidad:</label>
        <div class="controls">
          <input style="height:30px" required type="text" id="cantidad" name="cantidad" placeholder="Cantidad">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" required for="fechaCaducidad">Fecha caducidad:</label>
        <div class="controls">
          <input style="height:30px" type="date" id="fechaCaducidad" name="fechaCaducidad" value="<?=date('Y-m-d')?>"/>  
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="reset" class="btn">Limpiar</button>
        </div>
      </div>
    <?= form_close(); ?>
   </div>
 </div>


