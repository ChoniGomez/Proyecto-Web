<?php include "Views/Templates/header.php" ?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card badge-primary">
            <div class="card-body d-flex text-white">
                Usuarios
                <i class="fa fa-user fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url;?>Usuarios" class="text-white">Ver Detalles </a>
                <span class="text-white"><?php echo $data['usuarios']['total'];?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card badge-danger">
            <div class="card-body d-flex text-white">
                Productos
                <i class="fab fa-product-hunt fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url;?>Productos" class="text-white">Ver Detalles </a>
                <span class="text-white"><?php echo $data['productos']['total'];?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card badge-success">
            <div class="card-body d-flex text-white">
                Clientes
                <i class="fa fa-users fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url;?>Clientes" class="text-white">Ver Detalles </a>
                <span class="text-white"><?php echo $data['clientes']['total'];?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card badge-warning">
            <div class="card-body d-flex text-white">
                Ventas por Día
                <i class="fas fa-cash-register fa-2x ml-auto"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url;?>Ventas/historial_ventas" class="text-white">Ver Detalles </a>
                <span class="text-white"><?php echo $data['ventas']['total']?></span>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header badge-dark text-light">
                Productos con Stock Mínimo
            </div>
            <div class="card-body">
                <canvas id="stockMinimo" width="690" height="690"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header badge-dark text-light">
                Productos más Vendidos
            </div>
            <div class="card-body">
                <canvas id="productosMasVendidos" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php" ?>