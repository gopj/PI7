<div class="row-fluid">
   <div class="span12 ">
  <h2 class="offset3">Registrar salida</h2>
    <?= form_open('usuario-inventario/salidas/registrarSalida', 'class="form-horizontal"'); ?>
      <div class="control-group">
        <label class="control-label" for="idUsuario">Usuario:</label>
        <div class="controls">
          <?php
            if($choferes):
          ?>
              <select name="chofer", id='user'>
              <?php
              foreach($choferes->result() as $nom):
              ?>
              <option value="<?=$nom->idUsuario;?>"><?=$nom->nombre_usuario;?></option>
              <?php
              endforeach;?>
              </select><?php
            endif;
          ?>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="fechaSalida">Fecha salida:</label>
        <div class="controls">
          <input style="height:30px" type="date" id="fechaSalida" name="fechaSalida" value="<?=date( 'Y-m-d')?>"/>  
        </div>
      </div>
      <hr>
      <h2 class="offset3">Detalle salida</h2>
      <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
           title="Selecciona los productos" href="#productos" > Productos a asignar </a>
        </div>
        <div id="productos" class="accordion-body collapse">
          <div class="accordion-inner">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Producto</th>
                  <th>Presentacion</th>
                  <th>Caducidad</th>
                  <th>Precio</th>
                  <th>Cantidad actual</th>
                  <th>Cantidad asignar</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              //vemos si ventas contiene algo
              if($productos):
                $i = 1;
                foreach ($productos->result() as $producto): 
                  
                  if($producto->status == "1"): 
                    echo "<tr class='success'>";
                  else:
                    echo "<tr class='error'>"; 
                  endif;
                  ?>
                      <td>
                        <?= $producto->idProducto; ?>
                        <input type="checkbox" name="productos[]" id="check<?=$i?>" onclick="habilitarInput(check<?=$i?>,cantidad<?=$i?>)" value="<?= $producto->idProducto; ?>">
                      </td>
                      <td>
                        <?= $producto->nombre_producto; ?>
                      </td>
                      <td><?= $producto->presentacion . " gr"; ?></td>
                      <td><?= $producto->fecha_caducidad; ?></td> 
                      <td><?= $producto->precio_publico; ?></td>
                      <td><?= $producto->cantidad; ?></td> 
                      <td><input type="text" class="input-small" id="cantidad<?=$i?>"   name="cantidadAsignar[]" disabled="true" /></td>
                    </tr>
                  <?php 
                  $i++;
                endforeach;
              else:
                echo "<p>No hay productos</p>";
              endif;
            ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <hr>
      <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="reset" class="btn">Limpiar</button>
        </div>
      </div>
    <?= form_close(); ?>
   </div>
 </div>
<!--Funcion para habilitar  deshabilitar el input dentro de la fila--> 
<script type="text/javascript">
function habilitarInput(check, input){
  if(check.checked==true){
    input.disabled = false;
  }
  if(check.checked==false){
    input.disabled = true;
  }
}

function validar(tabla) {
  for(i=0; ele=tabla.elements[i]; i++){
    if (ele.type=='checkbox' && ele.checked)
      return true;
    alert('Error');
    return false;
  }
}
</script>

