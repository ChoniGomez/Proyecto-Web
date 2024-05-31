<?php
class ComprasModel extends Query{

    private $nombre, $id, $estado, $cod;

    public function __construct(){
        parent::__construct();
    }

  
    public function getCompras() {
        // trae a todas las compras
        $sql = "SELECT * FROM compras";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function registraCompra(string $nombre){
        $this->nombre = $nombre;
        // verifica si existe una compra con el mismo nombre
        $verificar = "SELECT * FROM categorias WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO categorias (nombre) VALUES (?)";
            $datos = array($this->nombre);
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

    // esta funcion solo trae a la compra que va a modificar
    public function editarComp(int $id){
        $sql = "SELECT * FROM compras WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarCompra(string $nombre, int $id){
        $this->nombre = $nombre;
        $this->id = $id;
        // verifica si existe una categoria con el mismo id
        $sql = "UPDATE categorias SET nombre = ? WHERE id = ?";
        $datos = array($this->nombre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }        
        return $res;
    }

    public function eliminarCompra(int $id){
        $this->id = $id;
        $sql = "UPDATE compras SET estado = 0 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function reactivarCompra(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE compras SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getProdCod(string $cod){
        $sql = "SELECT * FROM productos WHERE codigo = $cod";
        $data = $this->select($sql);
        return $data;
    }

    public function getProductos(int $id){
        $sql = "SELECT * FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalle(int $id_producto, int $id_usuario, string $precio, int $cantidad, string $sub_total){
        $sql = "INSERT INTO detalles (id_producto, id_usuario, precio, cantidad, sub_total) VALUES (?,?,?,?,?)";
        $datos = array ($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getDetalles(int $id){
        $sql = "SELECT d.*, p.id AS id_prod, p.descripcion FROM detalles d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function calcularCompras(int $id_usuario){
        $sql = "SELECT sub_total, SUM(sub_total) AS total FROM detalles WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteDetalle(int $id){
        $sql = "DELETE FROM detalles WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function consultarDetalle(int $id_producto, int $id_usuario){
        $sql = "SELECT * FROM detalles WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarDetalle(string $precio, int $cantidad, string $sub_total, int $id_producto, int $id_usuario){
        $sql = "UPDATE detalles SET precio = ?, cantidad = ?, sub_total = ? WHERE id_producto = ? AND id_usuario = ?";
        $datos = array ($precio, $cantidad, $sub_total, $id_producto, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function registrarCompra(string $total){
        $sql = "INSERT INTO compras (total) VALUES (?)";
        $datos = array ($total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function idCompra(){
        $sql = "SELECT MAX(id) AS id FROM compras";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalleCompra(int $id_compra, int $id_producto, int $cantidad, string $precio, string $sub_total){
        $sql = "INSERT INTO detalles_compras (id_compra, id_producto, cantidad, precio, sub_total) VALUES (?,?,?,?,?)";
        $datos = array ($id_compra, $id_producto, $cantidad, $precio, $sub_total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getEmpresa(){
        $sql = "SELECT * FROM configuraciones";
        $data = $this->select($sql);
        return $data;
    }

    public function vaciarDetalle(int $id_usuario){
        $sql = "DELETE FROM detalles WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getProductosCompras(int $id_compra){
        $sql = "SELECT c.*, d.*, p.id, p.descripcion FROM compras c INNER JOIN detalles_compras d ON c.id = d.id_compra INNER JOIN productos p ON p.id = d.id_producto WHERE c.id = $id_compra";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getHistorialCompras(){
        $sql = "SELECT * FROM compras";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function actualizarStock( int $cantidad,int $id_producto){
        $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $datos = array ($cantidad, $id_producto);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function deleteCompra(int $id_compra){
        $sql = "SELECT c.*, d.* FROM compras c INNER JOIN detalles_compras d ON c.id = d.id_compra  WHERE c.id = $id_compra";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function anularCompra(int $id_compra){
        $sql = "UPDATE compras SET estado = ? WHERE id = ?";
        $datos = array(0, $id_compra);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }        
        return $res;
    }

    public function verficarPermisos(int $id_usuario, string $nombre_permiso){
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalles_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre_permiso'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>