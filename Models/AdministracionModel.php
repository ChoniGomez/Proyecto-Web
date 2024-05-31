<?php
class AdministracionModel extends Query{

    private $cuit, $razonSocial, $direccion, $telefono, $correo, $localidad, $provincia, $cp, $mensaje, $id;

    public function __construct(){
        parent::__construct();
    }

  
    public function getEmpresa(){
        $sql = "SELECT * FROM configuraciones";
        $data = $this->select($sql);
        return $data;
    }

    ///// funcion para contar los elementos de una tabla
    public function getDatos(string $table){
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarEmpresa(string $cuit, string $razonSocial, string $direccion, string $telefono, string $correo, string $localidad, string $provincia, string $cp, string $mensaje, int $id){
        $this->id = $id;
        $this->cuit = $cuit;
        $this->razonSocial = $razonSocial;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->cp = $cp;
        $this->mensaje = $mensaje;
        $sql = "UPDATE configuraciones SET cuit = ?, razon_social = ?, direccion = ?, telefono = ?, correo = ?, localidad = ?, provincia = ?, cp = ?, mensaje = ? WHERE id = ?";
        $datos = array($cuit, $razonSocial, $direccion, $telefono, $correo, $localidad, $provincia, $cp, $mensaje, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else{
            $res = "error";
        }        
        return $res;
    }

    public function getStockMinimo() {
        /// muestra los primeros 10 con stock minimo de un total menor a 15
        $sql = "SELECT * FROM productos WHERE cantidad < 15 ORDER BY cantidad DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getProductosMasVendidos() {
        // muestra los primeros 10 productos mas vendidos
        $sql = "SELECT d.id_producto, d.cantidad, p.id, p.descripcion, SUM(d.cantidad) AS total FROM detalles_ventas d INNER JOIN productos p ON p.id = d.id_producto GROUP BY d.id_producto ORDER BY d.cantidad DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getVentas(){
        $sql = "SELECT COUNT(*) AS total FROM ventas WHERE fecha > CURDATE()";
        $data = $this->select($sql);
        return $data;
    }

    public function verficarPermisos(int $id_usuario, string $nombre_permiso){
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalles_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre_permiso'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>