<?php
class VentasModel extends Query{

    private $nombre, $id, $estado, $cod;

    public function __construct(){
        parent::__construct();
    }

  
    public function getVentas() {
        // trae a todas las ventas
        $sql = "SELECT * FROM ventas";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getClientes() {
        // trae a todas las ventas
        $sql = "SELECT * FROM clientes WHERE estado = 1";
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

    public function registrarDetalleVentasTemp(int $id_producto, int $id_usuario, string $precio, int $cantidad, string $sub_total){
        $sql = "INSERT INTO detalles_ventas_temp (id_producto, id_usuario, precio, cantidad, sub_total) VALUES (?,?,?,?,?)";
        $datos = array ($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getDetallesVentas(int $id){
        $sql = "SELECT d.*, p.id AS id_prod, p.descripcion FROM detalles_ventas_temp d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function calcularVentas(int $id_usuario){
        $sql = "SELECT sub_total, SUM(sub_total) AS total FROM detalles_ventas_temp WHERE id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteDetalle(int $id){
        $sql = "DELETE FROM detalles_ventas_temp WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function consultarDetalleVentas(int $id_producto, int $id_usuario){
        $sql = "SELECT * FROM detalles_ventas_temp WHERE id_producto = $id_producto AND id_usuario = $id_usuario";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarDetalleVentas(string $precio, int $cantidad, string $sub_total, int $id_producto, int $id_usuario){
        $sql = "UPDATE detalles_ventas_temp SET precio = ?, cantidad = ?, sub_total = ? WHERE id_producto = ? AND id_usuario = ?";
        $datos = array ($precio, $cantidad, $sub_total, $id_producto, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function registrarVenta(int $id_cliente, string $total){
        $sql = "INSERT INTO ventas (id_cliente, total) VALUES (?,?)";
        $datos = array ($id_cliente, $total);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function idVenta(){
        $sql = "SELECT MAX(id) AS id FROM ventas";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalleVenta(int $id_venta, int $id_producto, int $cantidad, string $descuento, string $precio, string $sub_total){
        $sql = "INSERT INTO detalles_ventas (id_venta, id_producto, cantidad, descuento, precio, sub_total) VALUES (?,?,?,?,?,?)";
        $datos = array ($id_venta, $id_producto, $cantidad, $descuento, $precio, $sub_total);
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

    public function vaciarDetalleVentasTemp(int $id_usuario){
        $sql = "DELETE FROM detalles_ventas_temp WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function getProductosVentas(int $id_venta){
        $sql = "SELECT v.*, d.*, p.id, p.descripcion FROM ventas v INNER JOIN detalles_ventas d ON v.id = d.id_venta INNER JOIN productos p  ON p.id = d.id_producto WHERE v.id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getHistorialVentas(){
        $sql = "SELECT c.id, c.nombre, v.* FROM clientes c INNER JOIN ventas v ON v.id_cliente = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function actualizarStock( int $cantidad,int $id_producto){
        $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $datos = array ($cantidad, $id_producto);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getClienteVenta(int $id_venta){
        $sql = "SELECT v.id, v.id_cliente, c.* FROM ventas v INNER JOIN clientes c ON c.id = v.id_cliente WHERE v.id = $id_venta";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarDescuento(string $descuento, string $sub_total,int $id){
        $sql = "UPDATE detalles_ventas_temp SET descuento = ?, sub_total = ? WHERE id = ?";
        $datos = array ($descuento, $sub_total, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function verificarDescuento($id){
        $sql = "SELECT * FROM detalles_ventas_temp WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function getDescuento($id_venta){
        $sql = "SELECT descuento, SUM(descuento) AS total FROM detalles_ventas WHERE id_venta = $id_venta";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteVenta(int $id_venta){
        $sql = "SELECT v.*, d.* FROM ventas v INNER JOIN detalles_ventas d ON v.id = d.id_venta  WHERE v.id = $id_venta";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function anularVenta(int $id_venta){
        $sql = "UPDATE ventas SET estado = ? WHERE id = ?";
        $datos = array(0, $id_venta);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = 'error';
        }        
        return $res;
    }
}
?>