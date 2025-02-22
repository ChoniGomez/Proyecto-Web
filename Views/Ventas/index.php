<?php include "Views/Templates/header.php" ?>
<div class="card">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Nueva Venta</h4>
        </div>
    </div>
    <div class="card-body">
        <form id="frmVenta">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="codigo"><i class="fas fa-barcode"></i> Código de Barra</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Ingrese el Código de Barra" onkeyup="buscarCodigoVenta(event)">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Descripción</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripción del Producto" disabled>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="cantidad">Cant</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" onkeyup="calcularPrecioVenta(event)" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio de Venta" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sub_total">Sub Total</label>
                        <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total" disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table table-light table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Aplicar Descuento (%)</th>
            <th>Descuento (%)</th>
            <th>Precio</th>
            <th>Sub Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tblDetallesVentas">
    </tbody>
</table>
<div class="row">
    <div class="col-md-4">
        .<div class="form-group">
            <label for="cliente">Seleccionar Cliente</label>
            <select id="cliente" class="form-control" name="cliente">
            <?php 
                $selectedId = null;

                // Buscar el ID de la opción "Ninguno"
                foreach ($data as $row) {
                    if ($row['nombre'] === "Ninguno") {
                        $selectedId = $row['id'];
                        break;
                    }
                }?>

                <?php foreach ($data as $row) { ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $selectedId) ? 'selected' : ''; ?>>
                        <?php echo $row['nombre']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3 ml-auto">
        <div class="form-group">
            <label for="total" class="font-weight-bold">Total</label>
            <input id="total" class="form-control" type="text" name="total" placeholder="Total" disabled>
            <button class="btn btn-primary mt-2 btn-block" type="button" onclick="generarVenta()">Generar Venta</button>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php" ?>