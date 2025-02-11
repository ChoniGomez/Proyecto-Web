<?php
class CajasModel extends Query{

    private $nombre_caja, $id, $estado, $fecha_apertura, $id_usuario, $monto_inicial;

    public function __construct(){
        parent::__construct();
    }

  
    public function getCajas() {
        // trae a todas las cajas
        $sql = "SELECT * FROM cajas";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function registrarCaja(string $nombre_caja){
        $this->nombre_caja = $nombre_caja;
        // verifica si existe una caja con el mismo nombre_caja
        $verificar = "SELECT * FROM cajas WHERE nombre_caja = '$this->nombre_caja'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO cajas (nombre_caja) VALUES (?)";
            $datos = array($this->nombre_caja);
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

    // esta funcion solo trae a la caja que se va a modificar
    public function editarCaja(int $id){
        $sql = "SELECT * FROM cajas WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarCaja(string $nombre_caja, int $id){
        $this->nombre_caja = $nombre_caja;
        $this->id = $id;
        // verifica si existe ua caja con el mismo id
        $sql = "UPDATE cajas SET nombre_caja = ? WHERE id = ?";
        $datos = array($this->nombre_caja, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }        
        return $res;
    }

    public function eliminarCaja(int $id){
        $this->id = $id;
        $sql = "UPDATE cajas SET estado = 0 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function reactivarCaja(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE cajas SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function registrarArqueo(int $id_usuario, string $monto_inicial, string $fecha_apertura){
        $this->id_usuario = $id_usuario;
        $this->monto_inicial = $monto_inicial;
        $this->fecha_apertura = $fecha_apertura;
        // verifica si existe un cierre de caja para un usuario
        $verificar = "SELECT * FROM cierre_cajas WHERE id_usuario = '$id_usuario' AND estado = 1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO cierre_cajas (id_usuario, monto_inicial, fecha_apertura) VALUES (?,?,?)";
            $datos = array($this->id_usuario, $this->monto_inicial, $this->fecha_apertura);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";// caja se abrio
            }else{
                $res = "error";
            }
        }else {
            $res = "existe";
        }        
        return $res;
    }

    public function getCierreCajas() {
        // trae a todos los cierres de cajas
        $sql = "SELECT * FROM cierre_cajas";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getVentas($id_usuario) {
        $sql = "SELECT total, SUM(total) AS total FROM ventas WHERE id_usuario = $id_usuario AND estado = 1 AND apertura = 1";// campo apertura es para el arqueo de caja
        $data = $this->select($sql);
        return $data;
    }

    public function getTotalVentas($id_usuario) {
        $sql = "SELECT COUNT(total) AS total FROM ventas WHERE id_usuario = $id_usuario AND estado = 1 AND apertura = 1";// campo apertura es para el arqueo de caja
        $data = $this->select($sql);
        return $data;
    }

    public function getMontoInicial($id_usuario) {
        $sql = "SELECT id, monto_inicial FROM cierre_cajas WHERE id_usuario = $id_usuario AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarArqueo(string $final, string $cierre, string $ventas, string $general, int $id){
        $sql = "UPDATE cierre_cajas SET monto_final = ?, fecha_cierre = ?, total_ventas = ?, monto_total = ?, estado = ? WHERE id = ?";
        $datos = array($final, $cierre, $ventas, $general, 0, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else{
            $res = "error";
        } 
        return $res;
    }

    public function actualizarApertura(int $id){
        $sql = "UPDATE ventas SET apertura = ? WHERE id_usuario = ?";
        $datos = array(0, $id);
        $this->save($sql, $datos);
    }

    public function verficarPermisos(int $id_usuario, string $nombre_permiso){
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalles_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre_permiso'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>