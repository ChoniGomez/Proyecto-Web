<?php
class UsuariosModel extends Query{
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
        $sql = "SELECT u.*, c.id, c.caja FROM usuarios u INNER JOIN cajas c WHERE u.id_caja = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    // trae a todos los tipos de cajas activas
    public function getCajas() {
        $sql = "SELECT * FROM cajas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>