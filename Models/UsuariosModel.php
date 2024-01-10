<?php
class UsuariosModel extends Query{

    private $usuario, $nombre, $clave, $id_caja;

    public function __construct(){
        parent::__construct();
    }
    public function getUsuario(string $usuario, string $clave) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios() {
        // trae a todos los usuarios con sus cajas
        $sql = "SELECT u.*, c.id as id_caja, c.caja FROM usuarios u INNER JOIN cajas c WHERE u.id_caja = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    // trae a todos los tipos de cajas activas
    public function getCajas() {
        $sql = "SELECT * FROM cajas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarUsuario(string $usuario, string $clave, string $nombre, int $id_caja){
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->id_caja = $id_caja;
        $sql = "INSERT INTO usuarios (usuario, nombre, clave, id_caja) VALUES (?,?,?,?)";
        $datos = array($this->usuario, $this->nombre, $this->clave, $this->id_caja);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else{
            $res = "error";
        }
        return $res;
    }
}
?>