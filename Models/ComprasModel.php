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


    public function registrarCompra(string $nombre){
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
}
?>