<!--Mostrar lista de clientes y obras -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Catálogo de Proveedores</h3>
  </div>
</div>



<div class="row">
  <div class="col-md-12">
    <div class="container-fluid">
      <div class="card bg-card">
        <div class="container">
          <table class="table table-striped table-bordered table-condensed" id="table_provider">
            <thead  class="bg-primary">
              <tr>
                <th>Nombre Fiscal</th>
                <th>Proveedor</th>
                <th>RFC</th>
                <th>Contacto 1</th>
                <th>Puesto 1</th>
                <th>Contacto 2</th>
                <th>Puesto 2</th>
                <th>Telefonos</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Comentarios</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($catalogo_proveedor->result() as $row) {
               ?>
               <tr>
                 <td id="<?php echo "nom_fiscal".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_nom_fiscal.""; ?></td>
                 <td id="<?php echo "proveedor".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
                 <td id="<?php echo "rfc".$row->id_catalogo_proveedor;?>"><?php echo "".$row->rfc.""; ?></td>
                 <td id="<?php echo "cont1".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_contacto1.""; ?></td>
                 <td id="<?php echo "puesto1".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_puesto1.""; ?></td>
                 <td id="<?php echo "cont2".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_contacto2.""; ?></td>
                 <td id="<?php echo "puesto2".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_puesto2.""; ?></td>
                 <td id="<?php echo "tels".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_tel1." y ".$row->catalogo_proveedor_tel2; ?></td>
                 <td id="<?php echo "cels".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_cel1." y ".$row->catalogo_proveedor_cel2; ?></td>
                 <td id="<?php echo "email".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_email1." y ".$row->catalogo_proveedor_email2; ?></td>
                 <td id="<?php echo "coment".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_coment; ?></td>

              </tr>
              <?php 
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>


<script type="text/javascript">
  $(document).ready( function () {
    $('#table_provider').DataTable();
  });
</script>