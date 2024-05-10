<?php include "Views/Templates/header.php" ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Cajas</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmCaja();">Nueva Caja <i class="fa fa-plus"></i></button>
<div class="table-responsive">
    <table class="table table-light" id="tblCajas">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nombre Caja</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> 
        </tbody>
    </table>
</div>
<div id="nueva_caja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nueva Caja</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCaja">
                    <div class="form-group">
                        <label for="nombre">Nombre Caja</label>
                        <input type="hidden" id="id" name="id">
                        <input id="nombre_caja" class="form-control" type="text" name="nombre_caja" placeholder="Nombre de la Caja">
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarCaja(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php" ?>