<?php
require_once('Config\App\Controller.php');
class Medidas extends Controller {
    
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {//verifico si la session no esta activada
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verficarPermisos($id_usuario, 'medidas');//verifico si el usuario tiene acceso a la ventana
        if (!empty($verificar)|| $id_usuario == 1) {// tambien pregunto si es superusuario
            $this->views->getView($this, "index");
        } else {
            header('Location: '.base_url.'Errores/permisos');
        }  
    }


    public function listar(){
        $data = $this->model->getMedidas();
         for ($i=0; $i < count($data); $i++) { 
             // codigo para mostrar el estado la medida
             if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                // codigo para agregar botones de editar y eliminar a cada medida que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="editarMed('.$data[$i]['id'].');"><i class="fa fa-edit"></i> Editar</button>
                <button class="btn btn-danger" type="button" onclick="eliminarMed('.$data[$i]['id'].');"><i class="fa fa-trash-alt"></i> Eliminar</button>
                </div>';
             }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                // codigo para agregar botones de reactivar a cada medida que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="reactivarMed('.$data[$i]['id'].');"><i class="fa fa-check"></i> Reactivar</button>
                </div>';
             }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $nombre = $_POST['nombre'];
        $nombre_corto = $_POST['nombre_corto'];
        $id = $_POST['id'];
        if (empty($nombre_corto) || empty($nombre)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id =="") {// en este caso se agrega uno nuevo xq no tiene id
                // aca se crea la medida
                $data = $this->model->registrarMedida($nombre, $nombre_corto);
                // verificar si el usuario se creo de manera exitosa
                if ($data == "ok") {
                    $msg = "si";
                }else if($data == "existe") {
                    $msg = "La Medida ya existe";
                }else {
                    $msg = "Error al registrar la medida";
                }                
            }else{
                // aca se modifica la medida
                $data = $this->model->modificarMedida($nombre, $nombre_corto, $id);
                // verificar si la medida se modifico de manera exitosa
                if ($data == "modificado") {
                    $msg = "modificado";
                }else {
                    $msg = "Error al modificar la medida";
                }
            }
               
        }
        echo json_encode($msg);
        die();
    }

    public function editar(int $id){        
        $data = $this->model->editarMed($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->eliminarMedida($id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar la medida";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reactivar($id){
        $data = $this->model->reactivarMedida(1, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al reactivar la medida";
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
