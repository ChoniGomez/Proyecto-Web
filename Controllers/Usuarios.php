<?php
require_once('Config\App\Controller.php');
class Usuarios extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        $this->views->getView($this, "index");
    }

    public function validar() {
        // si esta vacio el campo de usuario o clave
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos estan vacios";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $data = $this->model->getUsuario($usuario, $clave);
            // verifico si existe o no un usuario
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $msg = "ok";
            }else{
                $msg = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>