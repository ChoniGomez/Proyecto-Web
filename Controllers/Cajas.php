<?php
require_once('Config\App\Controller.php');
class Cajas extends Controller {
    
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {//verifico si la session no esta activada
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){
        $id_usuario = $_SESSION['id_usuario'];
        $verificar = $this->model->verficarPermisos($id_usuario, 'cajas');//verifico si el usuario tiene acceso a la ventana
        if (!empty($verificar)|| $id_usuario == 1) {// tambien pregunto si es superusuario
            $this->views->getView($this, "index");
        } else {
            header('Location: '.base_url.'Errores/permisos');
        }  
    }

    public function indexArqueoCaja(){
        $this->views->getView($this, "arqueoCajas");
    }

    public function listarCajas(){
        $data = $this->model->getCajas();
        for ($i=0; $i < count($data); $i++) { 
             // codigo para mostrar el estado de la caja
             if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                // codigo para agregar botones de editar y eliminar a cada caja que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="editarCaja('.$data[$i]['id'].');"><i class="fa fa-edit"></i> Editar</button>
                <button class="btn btn-danger" type="button" onclick="eliminarCaja('.$data[$i]['id'].');"><i class="fa fa-trash-alt"></i> Eliminar</button>
                </div>';
             }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                // codigo para agregar botones de reactivar a cada caja que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="reactivarCaja('.$data[$i]['id'].');"><i class="fa fa-check"></i>Reactivar</button>
                </div>';
             }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarCaja() {
        $nombre_caja = $_POST['nombre_caja'];
        $id = $_POST['id'];
        if (empty($nombre_caja)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id =="") {// en este caso se agrega uno nuevo xq no tiene id
                // aca se crea la caja
                $data = $this->model->registrarCaja($nombre_caja);
                // verificar si la caja se creo de manera exitosa
                if ($data == "ok") {
                    $msg = "si";
                }else if($data == "existe") {
                    $msg = "El nombre ya existe";
                }else {
                    $msg = "Error al registrar la caja";
                }                
            }else{
                // aca se modifica la caja
                $data = $this->model->modificarCaja($nombre_caja, $id);
                // verificar si la caja se modifico de manera exitosa
                if ($data == "modificado") {
                    $msg = "modificado";
                }else {
                    $msg = "Error al modificar la caja";
                }
            }               
        }
        echo json_encode($msg);
        die();
    }

    public function editar(int $id){        
        $data = $this->model->editarCaja($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->eliminarCaja($id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar la caja";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reactivar($id){
        $data = $this->model->reactivarCaja(1, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al reactivar la caja";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function abrirArqueo() {
        $monto_inicial = $_POST['monto_inicial'];
        $id = $_POST['id'];
        $fecha_apertura = date('Y-m-d');
        $id_usuario = $_SESSION['id_usuario'];
        if (empty($monto_inicial) || empty($fecha_apertura)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if ($id == '') {
                $data = $this->model->registrarArqueo($id_usuario, $monto_inicial, $fecha_apertura);
                // verificar si la caja se creo de manera exitosa
                if ($data == "ok") {
                    $msg = array('msg' => 'Caja abierta con exito', 'icono' => 'success');
                }else if($data == "existe") {
                    $msg = array('msg' => 'La caja ya esta abierta', 'icono' => 'warning');
                }else {
                    $msg = array('msg' => 'Error al abrir la caja', 'icono' => 'error');
                }     
            }else{//cierro la caja (actualizar el estado)
                $id_usuario = $_SESSION['id_usuario'];
                $data['monto_total'] = $this->model->getVentas($id_usuario);
                $monto_final = $data['monto_total']['total'];
                $data['total_ventas'] = $this->model->getTotalVentas($id_usuario);
                $total_ventas = $data['total_ventas']['total'];
                $data['inicial'] = $this->model->getMontoInicial($id_usuario);
                $general = $monto_final + $data['inicial']['monto_inicial'];
                $data = $this->model->actualizarArqueo($monto_final, $fecha_apertura, $total_ventas, $general, $data['inicial']['id']);
                // verificar si la caja se creo de manera exitosa
                if ($data == "ok") {
                    $this->model->actualizarApertura($id_usuario);
                    $msg = array('msg' => 'Caja cerrada con exito', 'icono' => 'success');
                }else{
                    $msg = array('msg' => 'Error al cerrar la caja', 'icono' => 'error');
                }     
            }                   
        }
        echo json_encode($msg);
        die();
    }

    public function listarArqueoCajas(){
        $data = $this->model->getCierreCajas();
        for ($i=0; $i < count($data); $i++) { 
             // codigo para mostrar el estado de la caja
             if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Abierta</span>';}
                else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Cerrada</span>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getVentas(){
        $id_usuario = $_SESSION['id_usuario'];
        $data['monto_total'] = $this->model->getVentas($id_usuario);
        $data['total_ventas'] = $this->model->getTotalVentas($id_usuario);
        $data['inicial'] = $this->model->getMontoInicial($id_usuario);
        $data['monto_general'] = $data['monto_total']['total'] + $data['inicial']['monto_inicial'];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
