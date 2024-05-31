<?php include "Views/Templates/header.php" ?>
<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            Asignar Permisos
        </div>
        <div class="card-body">
            <form method="post" id="formulario">
                <div class="row">
                    <?php foreach ($data['datos'] as $row) { ?>
                        <div class="col-md-4 text-center">
                            <div class="checkbox-wrapper-3">
                                <input type="checkbox" id="cbx-<?php echo $row['id']; ?>" name="permisos[]" value="<?php echo $row['id']; ?>" <?php echo isset($data['asignados'][$row['id']]) ? 'checked' : '';?>/>
                                <label for="cbx-<?php echo $row['id']; ?>" class="toggle"><span></span><?php echo $row['permiso'];?></label><br>
                            </div>
                        </div>                         
                    <?php }?>    
                    <input type="hidden" value="<?php echo $data['id_usuario'];?>" name="id_usuario">               
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-outline-primary" type="button" onclick="registrarPermisos(event);">Asignar Permisos</button> 
                    <a  class="btn btn-outline-danger" href="<?php echo base_url; ?>Usuarios">Cancelar</a>
                </div>                               
            </form>            
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php" ?>