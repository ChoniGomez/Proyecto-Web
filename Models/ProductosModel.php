<?php
class ProductosModel extends Query{

    private $codigo, $descripcion, $precio_compra, $precio_venta, $medida, $categoria, $id, $estado, $img;

    public function __construct(){
        parent::__construct();
    }
  
    public function getProductos() {
        // trae a todos los usuarios con sus cajas
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

    public function registrarProducto(string $codigo, string $descripcion, string $precio_compra, string $precio_venta, int $medida, int $categoria, string $img){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->medida = $medida;
        $this->categoria = $categoria;
        $this->img = $img;
        // verifica si existe un producto con el mismo codigo de producto
        $verificar = "SELECT * FROM productos WHERE codigo = '$this->codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO productos (codigo, descripcion, precio_compra, precio_venta, id_medida, id_categoria, foto) VALUES (?,?,?,?,?,?,?)";
            $datos = array($this->codigo, $this->descripcion, $this->precio_compra, $this->precio_venta, $this->medida, $this->categoria, $this->img);
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

    public function modificarProducto(string $codigo, string $descripcion, string $precio_compra, string $precio_venta, int $medida, int $categoria, string $img, int $id){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->medida = $medida;
        $this->categoria = $categoria;
        $this->img = $img;
        $this->id = $id;
        $sql = "UPDATE productos SET codigo = ?, descripcion = ?, precio_compra = ?, precio_venta = ?, id_medida = ?, id_categoria = ?, foto = ? WHERE id = ?";
        $datos = array($this->codigo, $this->descripcion, $this->precio_compra, $this->precio_venta, $this->medida, $this->categoria, $this->img, $this->id);
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