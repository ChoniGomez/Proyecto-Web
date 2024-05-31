<?php
class MedidasModel extends Query{

    private $nombre, $nombre_corto, $id, $estado;

    public function __construct(){
        parent::__construct();
    }

  
    public function getMedidas() {
        // trae a todos las medidas
        $sql = "SELECT * FROM medidas";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function registrarMedida(string $nombre, string $nombre_corto){
        $this->nombre = $nombre;
        $this->nombre_corto = $nombre_corto;

        // verifica si existe una medida con el mismo nombre
        $verificar = "SELECT * FROM medidas WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO medidas (nombre, nombre_corto) VALUES (?,?)";
            $datos = array($this->nombre, $this->nombre_corto);
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

    // esta funcion solo trae a la medida que va a modificar
    public function editarMed(int $id){
        $sql = "SELECT * FROM medidas WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarMedida(string $nombre, string $nombre_corto, int $id){
        $this->nombre = $nombre;
        $this->nombre_corto = $nombre_corto;
        $this->id = $id;
        // verifica si existe una medida con el mismo id
        $sql = "UPDATE medidas SET nombre = ?, nombre_corto = ? WHERE id = ?";
        $datos = array($this->nombre, $this->nombre_corto, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }        
        return $res;
    }

    public function eliminarMedida(int $id){
        $this->id = $id;
        $sql = "UPDATE medidas SET estado = 0 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function reactivarMedida(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE medidas SET estado = ? WHERE id = ?";
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