<?php
require_once('Config\App\Controller.php');
class Compras extends Controller {
    
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {//verifico si la session no esta activada
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){
        $this->views->getView($this, "index");
    }


    public function listar(){
        $data = $this->model->getClientes();
         for ($i=0; $i < count($data); $i++) { 
             // codigo para mostrar el estado del usuario
             if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                // codigo para agregar botones de editar y eliminar a cada cliente que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="editarCli('.$data[$i]['id'].');"><i class="fa fa-edit"></i> Editar</button>
                <button class="btn btn-danger" type="button" onclick="eliminarCli('.$data[$i]['id'].');"><i class="fa fa-trash-alt"></i> Eliminar</button>
                </div>';
             }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                // codigo para agregar botones de reactivar a cada cliente que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="reactivarCli('.$data[$i]['id'].');"><i class="fa fa-check"></i>Reactivar</button>
                </div>';
             }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $id = $_POST['id'];
        if (empty($dni) || empty($nombre) || empty($telefono) || empty($direccion)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id =="") {// en este caso se agrega uno nuevo xq no tiene id
                // aca se crea el cliente
                $data = $this->model->registrarCliente($dni, $nombre, $telefono, $direccion);
                // verificar si el usuario se creo de manera exitosa
                if ($data == "ok") {
                    $msg = "si";
                }else if($data == "existe") {
                    $msg = "El DNI ya existe";
                }else {
                    $msg = "Error al registrar el cliente";
                }                
            }else{
                // aca se modifica el cliente
                $data = $this->model->modificarCliente($dni, $nombre, $telefono, $direccion, $id);
                // verificar si el cliente se modifico de manera exitosa
                if ($data == "modificado") {
                    $msg = "modificado";
                }else {
                    $msg = "Error al modificar el cliente";
                }
            }
               
        }
        echo json_encode($msg);
        die();
    }

    public function editar(int $id){        
        $data = $this->model->editarCli($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->eliminarCliente($id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reactivar($id){
        $data = $this->model->reactivarCliente(1, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al reactivar el cliente";
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