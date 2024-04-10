<?php include "Views/Templates/header.php" ?>
<div class="card">
    <div class="card-header bg-dark text-white">
        Datos de la Empresa
        
    </div>
    <div class="card-body">
        <form id="frmEmpresa">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['id'] ?>">
                        <label for="razonSocial">Razón Social</label>
                        <input id="razonSocial" class="form-control" type="text" name="razonSocial" placeholder="Razón Social" value="<?php echo $data['razon_social'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cuit">CUIT</label>
                        <input id="cuit" class="form-control" type="text" name="cuit" placeholder="CUIT" value="<?php echo $data['cuit'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Dirección" value="<?php echo $data['direccion'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono" value="<?php echo $data['telefono'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input id="correo" class="form-control" type="text" name="correo" placeholder="Correo" value="<?php echo $data['correo'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="localidad">Localidad</label>
                        <input id="localidad" class="form-control" type="text" name="localidad" placeholder="Localidad" value="<?php echo $data['localidad'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <input id="provincia" class="form-control" type="text" name="provincia" placeholder="Provincia" value="<?php echo $data['provincia'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cp">Código Postal</label>
                        <input id="cp" class="form-control" type="text" name="cp" placeholder="Código Postal" value="<?php echo $data['cp'] ?>">
                    </div>
                </div>                
            </div>     
            <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" class="form-control" name="mensaje" placeholder="Mensaje" rows="3" ><?php echo $data['mensaje'] ?></textarea>
            </div>
            <button class="btn btn-primary" type="button" onclick="modificarEmpresa()">Modificar</button>
        </form>
    </div>
</div>
<?php include "Views/Templates/footer.php" ?>