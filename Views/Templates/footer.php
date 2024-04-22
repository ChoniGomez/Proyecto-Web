</div>
</main>
<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <a href="https://github.com/ChoniGomez" target="_blank" rel="noopener noreferrer"> Visite mi perfil de GitHub</a> <?php echo date("Y");?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
</footer>
</div>
</div>


<div id="cambiar_pass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Cambiar Contraseña</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCambiarPass">
                <div class="form-group">
                        <label for="clave_actual">Contraseña Actual</label>
                        <input id="clave_actual" class="form-control" type="password" name="clave_actual" placeholder="Contraseña Actual">
                    </div>
                    <div class="form-group">
                        <label for="clave_nueva">Contraseña Nueva</label>
                        <input id="clave_nueva" class="form-control" type="password" name="clave_nueva" placeholder="Contraseña Nueva">
                    </div>
                    <div class="form-group">
                        <label for="confirmar_clave">Confirmar Contraseña</label>
                        <input id="confirmar_clave" class="form-control" type="password" name="confirmar_clave" placeholder="Confirmar Contraseña">
                    </div>
                    <button class="btn btn-primary" type="button" onclick="cambiarPass(event)" id="btnAccionPass">Cambiar Contraseña</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <script src="<?php echo base_url;?>Assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url;?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url;?>Assets/js/scripts.js"></script>
        <script src="<?php echo base_url;?>Assets/DataTables/datatables.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url;?>Assets/demo/datatables-demo.js"></script>
        <script>
            const base_url = "<?php echo base_url; ?>";
        </script>
        <script src="<?php echo base_url;?>Assets/js/chart.umd.min.js"></script>
        <script src="<?php echo base_url;?>Assets/js/Chart.min.js"></script>
        <script src="<?php echo base_url;?>Assets/js/sweetalert2.all.min.js"></script>
        <script src="<?php echo base_url;?>Assets/js/select2.min.js"></script>
        <script src="<?php echo base_url;?>Assets/js/funciones.js"></script>
    </body>
</html>
