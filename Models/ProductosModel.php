<?php
class ProductosModel extends Query{

    private $codigo, $descripcion, $precio_compra, $precio_venta, $medida, $categoria, $id, $estado, $img, $codigo_proveedor, $iva, $porcentaje_ganancia, $precio_iva, $fecha_modificacion;

    public function __construct(){
        parent::__construct();
    }
  
    public function getProductos() {
        // trae a todos los productos
        $sql = "SELECT p.*, m.id AS id_medida, m.nombre AS medida, c.id AS id_categoria, c.nombre AS categoria FROM productos p INNER JOIN medidas m ON p.id_medida = m.id INNER JOIN categorias c ON p.id_categoria = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    // trae a todos los tipos de cajas activas
    public function getCajas() {
        $sql = "SELECT * FROM cajas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    // trae a todos las categorias activas
    public function getCategorias() {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    // trae a todos los tipos de medidas activas
    public function getMedidas() {
        $sql = "SELECT * FROM medidas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    //    $codigo, $codigo_proveedor,                                               $descripcion, $iva, $porcentaje_ganancia, $precio_iva, $precio_compra, $precio_venta, $medida, $categoria, $imgNombre, $fecha_modificacion
    public function registrarProducto(string $codigo, string $codigo_proveedor, string $descripcion, int $iva, string $porcentaje_ganancia, string $precio_iva, string $precio_compra, string $precio_venta, int $medida, int $categoria, string $img, string $fecha_modificacion){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->medida = $medida;
        $this->categoria = $categoria;
        $this->img = $img;        
        $this->codigo_proveedor = $codigo_proveedor;
        $this->iva = $iva; 
        $this->porcentaje_ganancia = $porcentaje_ganancia;
        $this->precio_iva = $precio_iva;
        $this->fecha_modificacion = $fecha_modificacion;
        // verifica si existe un producto con el mismo codigo de producto
        $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos (codigo, codigo_proveedor, descripcion, iva, porcentaje_ganancia, precio_compra, precio_iva, precio_venta, id_medida, id_categoria, foto, fecha_modificacion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->codigo_proveedor, $this->descripcion, $this->iva, $this->porcentaje_ganancia, $this->precio_compra, $this->precio_iva, $this->precio_venta, $this->medida, $this->categoria, $this->img, $this->fecha_modificacion);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else {
            $res = "existe";
        }        
        return $res;
    }

    // esta funcion solo trae a el producto que va a modificar
    public function editarProducto(int $id){
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarProducto(string $codigo, string $codigo_proveedor, string $descripcion, int $iva, string $porcentaje_ganancia, string $precio_iva, string $precio_compra, string $precio_venta, int $medida, int $categoria, string $img, string $fecha_modificacion, int $id){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->medida = $medida;
        $this->categoria = $categoria;
        $this->img = $img;
        $this->codigo_proveedor = $codigo_proveedor;
        $this->iva = $iva; 
        $this->porcentaje_ganancia = $porcentaje_ganancia;
        $this->precio_iva = $precio_iva;
        $this->fecha_modificacion = $fecha_modificacion;
        $this->id = $id;

        ////   codigo, codigo_proveedor, descripcion, iva, porcentaje_ganancia, precio_compra, precio_iva, precio_venta, id_medida, id_categoria, foto, fecha_modificacion
        $sql = "UPDATE productos SET codigo = ?, codigo_proveedor = ?, descripcion = ?, iva = ?, porcentaje_ganancia = ?, precio_compra = ?, precio_iva = ?, precio_venta = ?, id_medida = ?, id_categoria = ?, foto = ?, fecha_modificacion = ? WHERE id = ?";
        $datos = array($this->codigo, $this->codigo_proveedor, $this->descripcion, $this->iva, $this->porcentaje_ganancia, $this->precio_compra, $this->precio_iva, $this->precio_venta, $this->medida, $this->categoria, $this->img, $this->fecha_modificacion, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }        
        return $res;
    }

    public function eliminarProducto(int $id){
        $this->id = $id;
        $sql = "UPDATE productos SET estado = 0 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function reactivarProducto(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE productos SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function verficarPermisos(int $id_usuario, string $nombre_permiso){
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalles_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre_permiso'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>