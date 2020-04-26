<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <h3>Listado de cajas chicas</h3>
    </div>
    <div class="col-md-1"></div>
</div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card bg-card">
                <div class="margins">
                    <div class="table-responsive-lg">
                        <table  class="table table-hover" style="font-size: 10pt;">
                            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                                <tr>
                                    <th>No. Caja Chica</th>
                                    <th>Caja Chica</th>
                                    <th></th>
                                    <th>Gasto de caja chica</th>
                                    <th></th>
                                    <th>Saldo Actual</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><?php foreach ($cash->result() as $row) {?>
                                    <td><?php echo $row->id_caja_chica; ?></td>
                                    <td><?php echo $row->caja_chica_mes; ?></td>
                                    <td>$</td>
                                    <td><?php echo $row->caja_chica_total; ?></td>
                                    <td>$</td>
                                    <td><?php echo $row->caja_chica_saldo; ?></td>
                                    <td align="center"><a role="button" class="btn btn-outline-dark" onclick="Details(this.id)" id="<?php echo $row->id_caja_chica; ?>"><img src="..\Resources\Icons\lupa.ico" alt="Editar" style="filter: invert(100%)" /></a>
                                    </td>
                                </tr><?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>

<script type="text/javascript">
    function Details($id) {
   // alert('Ver Detalles');
   var id_caja_chica=$id;
   $("#page_content").load("PettyCashDetails",{id_caja_chica:id_caja_chica});
                      
 }
</script>