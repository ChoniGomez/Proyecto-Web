<?php include "Views/Templates/header.php" ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Arqueo de Cajas</li>
</ol>
<button class="btn btn-success mb-2" type="button" onclick="mostrarFrmArqueoCaja();">Nuevo Arqueo de Caja <i class="fa fa-plus"></i></button>
<button class="btn btn-danger mb-2" type="button" onclick="cerrarArqueoCaja();">Cerrar Caja <i class="fa fa-plus"></i></button>
<div class="table-responsive">
    <table class="table table-light" id="tblArqueoCajas">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Monto Inicial</th>
                <th>Monto Final</th>
                <th>Fecha Apertura</th>
                <th>Fecha Cierre</th>
                <th>Total Ventas</th>
                <th>Monto Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody> 
        </tbody>
    </table>
</div>
<div id="abrir_caja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Arqueo Caja</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAbrirCaja">
                    <div class="form-group">
                        <label for="monto_inicial">Monto Inicial</label>
                        <input type="hidden" id="id" name="id">
                        <input id="monto_inicial" class="form-control" type="text" name="monto_inicial" placeholder="Monto Inicial">
                    </div>
                    <div class="form-group">
                        <label for="fecha_apertura">Fecha Apertura</label>
                        <input id="fecha_apertura" class="form-control" type="date" value="<?php echo date("Y-m-d"); ?>" name="fecha_apertura" >
                    </div>
                        <div id="ocultar_campos">
                        <div class="form-group">
                            <label for="monto_final">Monto Final</label>
                            <input id="monto_final" class="form-control" type="text" disabled>
                        </div>
                        <div class="form-group">
                            <label for="total_ventas">Total Ventas</label>
                            <input id="total_ventas" class="form-control" type="text" disabled>
                        </div>
                        <div class="form-group">
                            <label for="monto_general">Monto Total</label>
                            <input id="monto_general" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="abrirArqueoCaja(event);" id="btnAccion">Abrir</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php" ?>