<?php
class CategoriasModel extends Query{

    private $nombre, $id, $estado;

    public function __construct(){
        parent::__construct();
    }

  
    public function getCategorias() {
        // trae a todas las categorias
        $sql = "SELECT * FROM categorias";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function registrarCategoria(string $nombre){
        $this->nombre = $nombre;
        // verifica si existe una categoria con el mismo nombre
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

    // esta funcion solo trae a la categoria que va a modificar
    public function editarCat(int $id){
        $sql = "SELECT * FROM categorias WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarCategoria(string $nombre, int $id){
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

    public function eliminarCategoria(int $id){
        $this->id = $id;
        $sql = "UPDATE categorias SET estado = 0 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function reactivarCategoria(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE categorias SET estado = ? WHERE id = ?";
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