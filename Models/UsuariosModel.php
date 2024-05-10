<?php
class UsuariosModel extends Query{

    private $usuario, $nombre, $clave, $id_caja, $id, $estado;

    public function __construct(){
        parent::__construct();
    }

    // busca a el usuario por nombre y clave para loguearse al sistema
    public function getUsuario(string $usuario, string $clave) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios() {
        // trae a todos los usuarios con sus cajas
        $sql = "SELECT u.*, c.id as id_caja, c.nombre_caja FROM usuarios u INNER JOIN cajas c WHERE u.id_caja = c.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    // trae a todos los tipos de cajas activas
    public function getCajas() {
        $sql = "SELECT * FROM cajas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarUsuario(string $usuario, string $nombre, string $clave, int $id_caja){
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->id_caja = $id_caja;
        // verifica si existe un usuario con el mismo nombre de usuario
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios (usuario, nombre, clave, id_caja) VALUES (?,?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->clave, $this->id_caja);
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

    // esta funcion solo trae a el usuario que va a modificar
    public function editarUsuario(int $id){
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarUsuario(string $usuario, string $nombre, int $id_caja, int $id){
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->id = $id;
        $this->id_caja = $id_caja;
        // verifica si existe un usuario con el mismo nombre de usuario
        $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, id_caja = ? WHERE id = ?";
        $datos = array($this->usuario, $this->nombre, $this->id_caja, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }        
        return $res;
    }

    public function eliminarUsuario(int $id){
        $this->id = $id;
        $sql = "UPDATE usuarios SET estado = 0 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function reactivarUsuario(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function getPass(string $clave,int $id){
        $sql = "SELECT * FROM usuarios WHERE id = $id AND clave = '$clave'";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarPass(string $pass, int $id){
        $sql = "UPDATE usuarios SET clave = ? WHERE id = ?";
        $datos = array($pass, $id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
?>