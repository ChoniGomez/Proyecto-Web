<?php
require_once('Config\App\Controller.php');
class Usuarios extends Controller {
    
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        if (empty($_SESSION['activo'])) {//verifico si la session no esta activada
            header("location: ".base_url);
        }
        $data['cajas'] = $this->model->getCajas();
        $this->views->getView($this, "index", $data);
    }

    public function validar() {
        // si esta vacio el campo de usuario o clave
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos estan vacios";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash);// paso la clave encriptada
            // verifico si existe o no un usuario
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;// para hacer privadas las rutas
                $msg = "ok";
            }else{
                $msg = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar(){
        $data = $this->model->getUsuarios();
         for ($i=0; $i < count($data); $i++) {
            // codigo para mostrar el estado del usuario
            if ($data[$i]['estado'] == 1) { 
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';               
                if ($data[$i]['id'] == 1) { // id 1 esta reservado para el super usuario
                    $data[$i]['acciones'] = '<div>
                        <span class="badge badge-primary">Administrador</span>
                    </div>';
                }else {
                    // codigo para agregar botones de editar y eliminar a cada usuario que devuelvo
                    $data[$i]['acciones'] = '<div>
                    <a class="btn btn-dark" href="'.base_url.'Usuarios/permisos/'.$data[$i]['id'].'" ><i class="fa fa-key"></i> Permisos</a>
                    <button class="btn btn-primary" type="button" onclick="editarUser('.$data[$i]['id'].');"><i class="fa fa-edit"></i> Editar</button>
                    <button class="btn btn-danger" type="button" onclick="eliminarUser('.$data[$i]['id'].');"><i class="fa fa-trash-alt"></i> Eliminar</button>
                    </div>';
                }
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                // codigo para agregar botones de reactivar a cada usuario que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="reactivarUser('.$data[$i]['id'].');"><i class="fa fa-check"></i> Reactivar</button>
                </div>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $caja = $_POST['caja'];
        $id = $_POST['id'];// este campo solo se utiliza cuando se modofoca el usuario
        $hash = hash("SHA256", $clave);// encriptar la contraseña
        if (empty($usuario) || empty($nombre) || empty($caja)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id =="") {// en este caso se agrega uno nuevo xq no tiene id
                if ($clave != $confirmar) {
                    $msg = "Las contraseñas no coinciden";
                }else{
                    // aca se crea el usuario
                    $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $caja);
                    // verificar si el usuario se creo de manera exitosa
                    if ($data == "ok") {
                        $msg = "si";
                    }else if($data == "existe") {
                        $msg = "El usuario ya existe";
                    }else {
                        $msg = "Error al registrar el usuario";
                    }
                }                 
            }else{
                // aca se modifica el usuario
                $data = $this->model->modificarUsuario($usuario, $nombre, $caja, $id);
                // verificar si el usuario se modifico de manera exitosa
                if ($data == "modificado") {
                    $msg = "modificado";
                }else {
                    $msg = "Error al modificar el usuario";
                }
            }
               
        }
        echo json_encode($msg);
        die();
    }

    public function editar(int $id){        
        $data = $this->model->editarUsuario($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->eliminarUsuario($id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reactivar($id){
        $data = $this->model->reactivarUsuario(1, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al reactivar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    // funcion para desloguearse
    public function salir(){
        session_destroy();
        header("location: ".base_url);// redirecciona al login de usuario
    }

    public function cambiarPass(){
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];
        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
        }else {
            if ($nueva != $confirmar) {
                $msg = array('msg' => 'Las contraseñas no coinciden', 'icono' => 'warning');
            }else {
                $id = $_SESSION['id_usuario'];
                $hash = hash("SHA256", $actual);// encriptar la contraseña
                $data = $this->model->getPass($hash, $id);
                if (!empty($data)) {
                    $verificar = $this->model->modificarPass(hash("SHA256", $nueva), $id);
                    if ($verificar == 1) {
                        $msg = array('msg' => 'Contraseña modificada con exito', 'icono' => 'success');
                    } else {
                        $msg = array('msg' => 'Error al modificar la contraseña', 'icono' => 'error');
                    }                    
                }else {
                    $msg = array('msg' => 'La contraseña actual incorrecta', 'icono' => 'warning');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function permisos($id){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verficarPermisos($id_usuario, 'permisos');//verifico si el usuario tiene acceso a la ventana
        if (!empty($verificar)|| $id_usuario == 1) {// tambien pregunto si es superusuario
            if (empty($_SESSION['activo'])) {//verifico si la session no esta activada
                header("location: ".base_url);
            }
            $data['datos'] = $this->model->getPermisos();
            $data['id_usuario'] = $id;
            $permisos = $this->model->getDetallesPermisos($id);
            $data['asignados'] = array();
            foreach ($permisos as $permiso) {
                $data['asignados'][$permiso['id_permiso']] = true;// para activar los checkbox
            }
            $this->views->getView($this, "permisos", $data);
        } else {
            header('Location: '.base_url.'Errores/permisos');
        }        
        
    }

    public function registrarPermiso(){
        $msg = ''; 
        $id_usuario = $_POST['id_usuario'];
        $eliminar = $this->model->eliminarPermisos($id_usuario);
        if ($eliminar == 'ok') {
            foreach ($_POST['permisos'] as $id_permiso) {
                $msg = $this->model->registrarPermiso($id_usuario, $id_permiso);
            }
            if ($msg == 'ok') {
                $msg = array('msg' => 'Permiso asignado', 'icono' => 'success');
            } else {
                $msg = array('msg' => 'Error al asignar los permisos anteriores', 'icono' => 'error');
            }
        } else {
            $msg = array('msg' => 'Error al eliminar los permisos anteriores', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
