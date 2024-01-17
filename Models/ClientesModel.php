<?php
class ClientesModel extends Query{

    private $dni, $nombre, $telefono, $direccion, $id, $estado;

    public function __construct(){
        parent::__construct();
    }

  
    public function getClientes() {
        // trae a todos los clientes
        $sql = "SELECT * FROM clientes";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function registrarCliente(string $dni, string $nombre, string $telefono, string $direccion){
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;

        // verifica si existe un cliente con el mismo dni de cliente
        $verificar = "SELECT * FROM clientes WHERE dni = '$this->dni'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO clientes (dni, nombre, telefono, direccion) VALUES (?,?,?,?)";
            $datos = array($this->dni, $this->nombre, $this->telefono, $this->direccion);
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

    // esta funcion solo trae a el cliente que va a modificar
    public function editarCli(int $id){
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function modificarCliente(string $dni, string $nombre, string $telefono, string $direccion, int $id){
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id = $id;
        // verifica si existe un cliente con el mismo dni
        $sql = "UPDATE clientes SET dni = ?, nombre = ?, telefono = ?, direccion = ? WHERE id = ?";
        $datos = array($this->dni, $this->nombre, $this->telefono, $this->direccion, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }        
        return $res;
    }

    public function eliminarCliente(int $id){
        $this->id = $id;
        $sql = "UPDATE clientes SET estado = 0 WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function reactivarCliente(int $estado, int $id){
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE clientes SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
?>