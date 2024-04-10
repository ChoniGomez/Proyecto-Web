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

    public function buscarCodigo($cod){
        $data = $this->model->getProdCod($cod);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresar(){
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_compra'];
        $cantidad = $_POST['cantidad'];        
        // consulta a la BD para ver si hay 
        $comprobar = $this->model->consultarDetalle($id_producto, $id_usuario);
        if (empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
            if ($data == "ok") {
                $msg = "ok";
            } else {
                $msg = "Error al ingresar el producto";
            }
        }else {// si hay un producto duplicado
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $precio * $cantidad;
            $data = $this->model->modificarDetalle($precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
            if ($data == "modificado") {
                $msg = "modificado";
            } else {
                $msg = "Error al modificar el producto";
            }
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listarDetalles() {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalles($id_usuario);
        $data['total_pagar'] = $this->model->calcularCompras($id_usuario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($id){
        $data = $this->model->deleteDetalle($id);
        if ($data == 'ok') {
            $msg = 'ok';
        }else {
            $msg = 'error';
        }
        echo json_encode($msg);
        die();
    }

    public function registrarCompra() {
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularCompras($id_usuario);
        $data = $this->model->registrarCompra($total['total']);
        if ($data == 'ok') {
            $detalle = $this->model->getDetalles($id_usuario);
            $id_compra = $this->model->idCompra();
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $id_producto = $row['id_producto'];
                $sub_total = $cantidad * $precio;
                $this->model->registrarDetalleCompra($id_compra['id'], $id_producto, $cantidad, $precio, $sub_total);
                // incrementar el stock del producto
                $stock_actual = $this->model->getProductos($id_producto);
                $stock = $stock_actual['cantidad'] + $cantidad;
                $this->model->actualizarStock($stock, $id_producto);
            }
            $vaciarDetalle = $this->model->vaciarDetalle($id_usuario);
            if ($vaciarDetalle == 'ok') {
                $msg = array('msg' => 'ok', 'id_compra' => $id_compra['id']);
            }
        } else {
            $msg = 'Error al registrar la compra';
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPdfCompra($id_compra){
        // consulta a la BD para obtener los datos de la empresa
        $empresa = $this->model->getEmpresa();
        // obtener todos los productos de los detalles de una compra
        $productos = $this->model->getProductosCompras($id_compra);
        require('Libraries/fpdf/fpdf.php');

        $pdf = new FPDF('P','mm', array(100, 200));// en vez de A4, poner array(80, 200)
        $pdf->AddPage();
        $pdf->SetMargins(5, 0, 0);
        $pdf->SetTitle('Reporte de Compra');
        $pdf->SetFont('Arial','B', 14);
        $pdf->Cell(65 , 10, utf8_decode($empresa['razon_social']), 0, 1, 'L');
        $pdf->Image(base_url . 'Assets/img/el_estudiante_logo.png', 60, 16, 25 , 15);
        
        //cuit de la empresa
        $pdf->SetFont('Arial','B', 9);
        $pdf->Cell(18, 5, 'CUIT: ', 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, utf8_decode($empresa['cuit']), 0, 1, 'L');

        //telefono de la empresa
        $pdf->SetFont('Arial','B', 9);
        $pdf->Cell(18, 5, utf8_decode('Teléfono: '), 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, utf8_decode($empresa['telefono']), 0, 1, 'L');

        //direccion de la empresa
        $pdf->SetFont('Arial','B', 9);
        $pdf->Cell(18, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']), 0, 1, 'L');

        //correo de la empresa
        $pdf->SetFont('Arial','B', 9);
        $pdf->Cell(18, 5, utf8_decode('Correo: '), 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, utf8_decode($empresa['correo']), 0, 1, 'L');

        //localidad de la empresa
        $pdf->SetFont('Arial','B', 9);
        $pdf->Cell(18, 5, utf8_decode('Localidad: '), 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, utf8_decode($empresa['localidad']), 0, 1, 'L');

        //Provincia de la empresa
        $pdf->SetFont('Arial','B', 9);
        $pdf->Cell(18, 5, utf8_decode('Provincia: '), 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, utf8_decode($empresa['provincia']), 0, 1, 'L');

        //codigo Postal de la empresa
        $pdf->SetFont('Arial','B', 9);
        $pdf->Cell(18, 5, utf8_decode('C.P: '), 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, utf8_decode($empresa['cp']), 0, 1, 'L');

        //codigo Postal de la empresa
        $pdf->SetFont('Arial','B', 9);
        $pdf->Cell(18, 5, utf8_decode('Folio: '), 0, 0, 'L');
        $pdf->SetFont('Arial','', 9);
        $pdf->Cell(20, 5, $id_compra, 0, 1, 'L');

        //Encabezado de productos
        $pdf->Ln();//un salto de linea
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
        $pdf->Cell(35, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
        $pdf->Cell(20, 5, 'Precio', 0, 0, 'L', true);
        $pdf->Cell(20, 5, 'Sub Total', 0, 1, 'L', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        

        //detalles de la compra
        $total = 0.00;
        foreach ($productos as $row) {
            $total = $total + $row['sub_total'];
            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(35, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
            $pdf->Cell(20, 5, number_format($row['precio'], 2, '.', ','), 0, 0, 'L');
            $pdf->Cell(20, 5, number_format($row['sub_total'], 2, '.', ','), 0, 1, 'L');
        }

        /// sub total
        $pdf->Ln();//un salto de linea
        $pdf->Cell(80, 5, 'Total a pagar', 0, 1, 'R');
        $pdf->Cell(80, 5, number_format($total, 2, '.', ','), 0, 1, 'R');
        $pdf->Output();
    }

    public function historial(){
        $this->views->getView($this, "historial");
    }

    public function listar_historial(){
        $data = $this->model->getHistorialCompras();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
               <a class="btn btn-danger" href="'.base_url."Compras/generarPdfCompra/".$data[$i]['id'].'" target="_blank"><i class="fa fa-file-pdf"></i> Ver</a>
            </div>';
            $data[$i]['total'] = number_format($data[$i]['total'], 2, '.', ',');
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    //////////////////////////////////////////////////////////////// CODIGO PARA VENTAS //////////////////////////////////////////////////////////////////

    
}
?>