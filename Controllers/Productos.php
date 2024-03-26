<?php
require_once('Config\App\Controller.php');
class Productos extends Controller {
    
    public function __construct() {
        session_start();
        parent::__construct();
    }

    public function index(){
        if (empty($_SESSION['activo'])) {//verifico si la session no esta activada
            header("location: ".base_url);
        }
        $data['medidas'] = $this->model->getMedidas();
        $data['categorias'] = $this->model->getCategorias();
        $this->views->getView($this, "index", $data);
    }


    public function listar(){
        $data = $this->model->getProductos();
         for ($i=0; $i < count($data); $i++) { 
            // codigo para mostrar las fotos de los productos
            $data[$i]['imagen'] = '<img class="img-thumbnail" src="'.base_url. "Assets/img/" .$data[$i]['foto'].'" width = "100" >';
            // codigo para mostrar el estado del producto
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                // codigo para agregar botones de editar y eliminar a cada producto que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="editarProd('.$data[$i]['id'].');"><i class="fa fa-edit"></i> Editar</button>
                <button class="btn btn-danger" type="button" onclick="eliminarProd('.$data[$i]['id'].');"><i class="fa fa-trash-alt"></i> Eliminar</button>
                </div>';
            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                // codigo para agregar botones de reactivar a cada producto que devuelvo
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="reactivarProd('.$data[$i]['id'].');"><i class="fa fa-check"></i> Reactivar</button>
                </div>';
            }
            // formatear el valor a moneda
            setlocale(LC_MONETARY, 'en_US');
            $data[$i]['precio_venta'] =  number_format($data[$i]['precio_venta'], 2);
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $precio_compra = $_POST['precio_compra'];
        $precio_venta = $_POST['precio_venta'];
        $medida = $_POST['medida'];
        $categoria = $_POST['categoria'];
        $id = $_POST['id'];
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        if (empty($codigo) || empty($descripcion)|| empty($precio_compra)|| empty($precio_venta)|| empty($medida)|| empty($categoria)) {
            $msg = "Todos los campos son obligatorios";
        }else {
            if (!empty($name)) {
                $imgNombre = $fecha . ".jpg";
                $destino = "Assets/img/".$imgNombre;
            } else if (!empty($_POST['foto_actual']) && empty($name)) {
                $imgNombre = $_POST['foto_actual'];
            } else {
                $imgNombre = "default.jpg";
            }
            if ($id =="") {// en este caso se agrega uno nuevo xq no tiene id
                // aca se crea el producto
                $data = $this->model->registrarProducto($codigo, $descripcion, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre);
                // verificar si el producto se creo de manera exitosa
                if ($data == "ok") {
                    if (!empty($name)) {
                        move_uploaded_file($tmpname, $destino);
                    }
                    $msg = "si";
                }else if($data == "existe") {
                    $msg = "El producto ya existe";
                }else {
                    $msg = "Error al registrar el producto";
                }                
            }else{
                $imgDelete = $this->model->editarProducto($id);
                if ($imgDelete['foto'] != 'default.jpg') {
                    if (file_exists("Assets/img/" . $imgDelete['foto']) && $imgDelete['foto'] != 'default.jpg') {//aca tambien evito eliminar la imagen default.jpg
                        unlink("Assets/img/" . $imgDelete['foto']); // codigo para borrar la foto de la carpeta img
                    }
                }
                // aca se modifica el producto
                $data = $this->model->modificarProducto($codigo, $descripcion, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre, $id);
                // verificar si el producto se modifico de manera exitosa
                if ($data == "modificado") {
                    if (!empty($name)) {
                        move_uploaded_file($tmpname, $destino);
                    }
                    $msg = "modificado";
                }else {
                    $msg = "Error al modificar el producto";
                }  
            }
               
        }
        echo json_encode($msg);
        die();
    }

    public function editar(int $id){        
        $data = $this->model->editarProducto($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->eliminarProducto($id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al eliminar el producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reactivar($id){
        $data = $this->model->reactivarProducto(1, $id);
        if ($data == 1) {
            $msg = "ok";
        }else{
            $msg = "Error al reactivar el producto";
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