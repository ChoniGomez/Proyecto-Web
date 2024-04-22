<?php
require_once('Config\App\Controller.php');
class Administracion extends Controller {
    
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {//verifico si la session no esta activada
            header("location: ".base_url);
        }
        parent::__construct();
    }

    public function index(){
        $data = $this->model->getEmpresa();
        $this->views->getView($this, "index", $data);
    }

    public function home(){
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['clientes'] = $this->model->getDatos('clientes');
        $data['productos'] = $this->model->getDatos('productos');
        $data['ventas'] = $this->model->getVentas();
        $this->views->getView($this, "home", $data);
    }

    public function modificarDatosEmpresa(){
        $cuit = $_POST['cuit'];
        $razonSocial = $_POST['razonSocial'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $localidad = $_POST['localidad'];
        $provincia = $_POST['provincia'];
        $cp = $_POST['cp'];
        $mensaje = $_POST['mensaje'];
        $id = $_POST['id'];
        $data = $this->model->modificarEmpresa( $cuit, $razonSocial, $direccion, $telefono, $correo, $localidad, $provincia, $cp, $mensaje, $id);
        if ($data == 'ok') {
            $msg = 'ok';
        } else {
            $msg = 'error';
        }
        echo json_encode($msg);
        die();
    }

    public function reporteStock(){
        $data = $this->model->getStockMinimo();
        echo json_encode($data);
        die();
    }

    public function productosMasVendidos(){
        $data = $this->model->getProductosMasVendidos();
        echo json_encode($data);
        die();
    }

}
?>