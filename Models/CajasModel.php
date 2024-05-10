<?php
class CajasModel extends Query{

    private $nombre_caja, $id, $estado;

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
}
?>