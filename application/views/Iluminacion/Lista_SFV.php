<!--Mostrar lista de SFV -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Pagos SFV</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewSFVModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo SFV</button>
  </div>
</div>

<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_sfv" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Id_pago_SFV</th>
          <th>Nombre del Cliente</th>
          <th>idcliente</th>
          <th>KWh Totales</th>
          <th>Importe Total</th>
          <th>Total Pagado</th>
          <th>Saldo</th>
          <th>Fecha último pago</th>
          <th>Estado</th>
          <th>Pagos Realizados</th>
          <th>Total de Pagos</th>
          <th>Comentarios</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($lista_pagos_sfv->result() as $row) {
         ?>
         <tr>
          <td id="<?php echo "id_pago_sfv".$row->id_pago_sfv;?>"><?php echo "".$row->id_pago_sfv.""; ?></td>
          <td id="<?php echo "nom_cliente".$row->id_pago_sfv;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
          <td id="<?php echo "id_cliente".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_id_cliente.""; ?></td>
          <td id="<?php echo "kwh_totales".$row->id_pago_sfv;?>">$<?php echo "".$row->pago_sfv_kwh.""; ?></td>
          <td id="<?php echo "imp_total".$row->id_pago_sfv;?>">$<?php echo "".$row->pago_sfv_imp_total.""; ?></td>
          <td id="<?php echo "total_pagado".$row->id_pago_sfv;?>">$<?php echo "".$row->pago_sfv_pagado.""; ?></td>
          <td id="<?php echo "saldo".$row->id_pago_sfv;?>">$<?php echo "".$row->pago_sfv_saldo.""; ?></td>
          <td id="<?php echo "fecha_ult_pago".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_fecha_ult_pago.""; ?></td>
          <td id="<?php echo "estado".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_estado.""; ?></td>
          <td id="<?php echo "pagos_realizados".$row->id_pago_sfv;?>"><?php echo "".$row->pagos_realizados.""; ?></td>
          <td id="<?php echo "total_pagos".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_cant_pagos.""; ?></td>
          <td id="<?php echo "coment".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_coment.""; ?></td>
          <td>
            <a class="navbar-brand" href="#" onclick="EditAnticipo(this.id)" role="button" id="<?php echo $row->id_pago_sfv; ?>">
              <button class="btn btn-outline-secondary " title="Editar Registro"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" style="filter: invert(100%)" />
              </button>
            </a>
          </td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
</div>
</div>

<!-- Modal New SFV -->
<div class="modal fade" id="NewSFVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo SFV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Cliente</label>
        <select class="form-control" id="new_cliente">
          <option disabled selected>----Seleccionar Cliente----</option>
          <?php foreach ($catalogo_cliente->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
          <?php } ?>
        </select>
        <label>KWh Totales</label><br>   
        <input type="number" min="0" id="new_kwh" class="form-control input-sm"><br>
        <label>Total de Pagos</label><br>
        <input type="number" min="1" id="new_cant_pagos" class="form-control input-sm"><br>
        <label>Importe Total</label><br>
        <input type="number" min="0" id="new_imp_total" class="form-control input-sm"><br>
        <label>Comentarios</label><br>
        <textarea id="new_coment" maxlength="150" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewSFV" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_sfv').DataTable();

    $('#NewSFV').click(function(){
      cliente=$('#new_cliente').val();
      kwh=$('#new_kwh').val();
      cant_pagos=$('#new_cant_pagos').val();
      imp_total=$('#new_imp_total').val();
      coment=$('#new_coment').val();
      alert(cliente+kwh+cant_pagos+imp_total+coment);
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/NewSFV",
        data:{cliente:cliente, kwh:kwh, cant_pagos:cant_pagos, imp_total:imp_total, coment:coment},
        success:function(result){
            //alert(result);
            if(result){
              alert('Nuevo SFV Agregado');
            }else{
              alert('Falló el servidor. Nuevo SFV no Agregado');
            }
            Update();
          }
        });
    });

  });


function Update(){
  $('#btncancelar').click();
  $("#page_content").load("Pagos_SFV");
}

</script>