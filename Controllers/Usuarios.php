<?php
require_once('Config\App\Controller.php');
class Usuarios extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
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

    public function listar(){
        $data = $this->model->getUsuarios();
         for ($i=0; $i < count($data); $i++) { 
             // codigo para mostrar el estado del usuario
             if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
             }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
             }
             // codigo para agregar botones de editar y eliminar a cada usuario que devuelvo
             $data[$i]['acciones'] = '<div>
             <button class="btn btn-primary" type="button">Editar</button>
             <button class="btn btn-danger" type="button">Eliminar</button>
             </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
