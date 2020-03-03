<!DOCTYPE html>
<html>
<head>
    <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="..\assets\Personalized\DataTables\datatables.min.css">
    <script src="..\assets\Jquery\jquery-3.4.1.min.js"></script>
</head>
<body>
<br>

<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="container">
            <div class="card bg-card">
            <div class="container">
                <br>
                <table id="table_id" class="table table-hover display" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Ud. medida</th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            <th>Fecha de act.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($inventories->result() as $row) {?>
                            <tr>
                                <td><?php echo "".$row->id_catalogo_producto.""; ?></td>
                                <td><?php echo "".$row->catalogo_producto_nombre.""; ?></td>
                                <td><?php echo "".$row->catalogo_producto_umedida.""; ?></td>
                                <td><?php echo "".$row->catalogo_producto_precio.""; ?></td>
                                <td><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
                                <td><?php echo "".$row->catalogo_producto_fecha_actualizacion.""; ?></td>
                                <td><a class="navbar-brand" role="button"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico"></a> <a class="navbar-brand" role="button"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico"></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<br>

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>

<script type="text/javascript" src="..\assets\Personalized\DataTables\datatables.min.js"></script>
</body>
</html>