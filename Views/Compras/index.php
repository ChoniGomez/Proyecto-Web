<?php include "Views/Templates/header.php" ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Nueva Compra</li>
</ol>
<div class="card">
    <div class="card-body">
        <form id="frmCompra">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="codigo">Código de Barra</label>
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Ingrese el Código de Barra">
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
                        <input id="cantidad" class="form-control" type="number" name="cantidad">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio de Compra" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sub_total">Sub Total</label>
                        <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary mt-4" type="button">Generar Compra</button>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input id="total" class="form-control" type="text" name="total" placeholder="Total" disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table table-light">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Sub Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<?php include "Views/Templates/footer.php" ?>