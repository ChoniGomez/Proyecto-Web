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
                // codigo para agregar botones de editar y eliminar a cada usuario que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="editarUser('.$data[$i]['id'].');"><i class="fa fa-edit"></i> Editar</button>
                <button class="btn btn-danger" type="button" onclick="eliminarUser('.$data[$i]['id'].');"><i class="fa fa-trash-alt"></i> Eliminar</button>
                </div>';
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
}
?>
